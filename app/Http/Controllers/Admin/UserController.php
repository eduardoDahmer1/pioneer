<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Currency;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        parent::__construct();
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = User::orderBy('id', 'DESC');
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->addColumn('action', function (User $data) {
                return '
                <div class="godropdown">
                    <button class="go-dropdown-toggle"> ' . __('Actions') . '<i class="fas fa-chevron-down"></i></button>
                    <div class="action-list">
                        <a href="' . route('admin-user-show', $data->id) . '" >
                            <i class="fas fa-eye"></i> ' . __('Details') . '
                        </a>
                        <a data-href="' . route('admin-user-edit', $data->id) . '" data-header="' . __('Edit Customer') . '" class="edit" data-toggle="modal" data-target="#modal1">
                            <i class="fas fa-edit"></i> ' . __('Edit') . '
                        </a>
                        <a href="javascript:;" class="send" data-email="' . $data->email . '" data-toggle="modal" data-target="#vendorform">
                            <i class="fas fa-envelope"></i> ' . __('Send Email') . '
                        </a>
                        <a href="javascript:;" data-href="' . route('admin-user-delete', $data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete">
                            <i class="fas fa-trash-alt"></i> ' . __('Delete') . '
                        </a>
                    </div>
                </div>';
            })
            ->addColumn('ban', function (User $data) {
                $s = $data->ban == 1 ? 'checked' : '';
                return '<div class="fix-social-links-area social-links-area"><label class="switch"><input type="checkbox" class="droplinks drop-sucess checkboxBan" id="checkbox-ban-'.$data->id.'" name="'.route('admin-user-ban', ['id1' => $data->id, 'id2' => $data->ban]).'"'.$s.'><span class="slider round"></span></label></div>';
            })
            ->rawColumns(['action', 'ban'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.user.index');
    }

    //*** GET Request
    public function image()
    {
        return view('admin.generalsetting.user_image');
    }

    //*** GET Request
    public function show($id)
    {
        if (!User::where('id', $id)->exists()) {
            return redirect()->route('admin.dashboard')->with('unsuccess', __('Sorry the page does not exist.'));
        }
        $currencies = Currency::orderBy('id')->get();
        $data = User::findOrFail($id);
        return view('admin.user.show', compact('data', 'currencies'));
    }

    //*** GET Request
    public function ban($id1, $id2)
    {
        $user = User::findOrFail($id1);
        $user->ban = $id2;
        $user->update();
    }

    //*** GET Request
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.user.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
                   'photo' => 'mimes:jpeg,jpg,png,svg',
                    ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $user = User::findOrFail($id);
        $data = $request->all();
        if ($file = $request->file('photo')) {
            $name = time().$file->getClientOriginalName();
            $file->move('storage/images/users', $name);
            if ($user->photo != null) {
                if (file_exists(public_path().'/storage/images/users/'.$user->photo)) {
                    unlink(public_path().'/storage/images/users/'.$user->photo);
                }
            }
            $data['photo'] = $name;
        }
        $user->update($data);
        $msg = __('Customer Information Updated Successfully.');
        return response()->json($msg);
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $user = User::findOrFail($id);


        if ($user->reports->count() > 0) {
            foreach ($user->reports as $gal) {
                $gal->delete();
            }
        }


        if ($user->shippings->count() > 0) {
            foreach ($user->shippings as $gal) {
                $gal->delete();
            }
        }


        if ($user->packages->count() > 0) {
            foreach ($user->packages as $gal) {
                $gal->delete();
            }
        }


        if ($user->ratings->count() > 0) {
            foreach ($user->ratings as $gal) {
                $gal->delete();
            }
        }

        if ($user->notifications->count() > 0) {
            foreach ($user->notifications as $gal) {
                $gal->delete();
            }
        }

        if ($user->wishlists->count() > 0) {
            foreach ($user->wishlists as $gal) {
                $gal->delete();
            }
        }

        if ($user->withdraws->count() > 0) {
            foreach ($user->withdraws as $gal) {
                $gal->delete();
            }
        }

        if ($user->socialProviders->count() > 0) {
            foreach ($user->socialProviders as $gal) {
                $gal->delete();
            }
        }

        if ($user->conversations->count() > 0) {
            foreach ($user->conversations as $gal) {
                if ($gal->messages->count() > 0) {
                    foreach ($gal->messages as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }
        if ($user->comments->count() > 0) {
            foreach ($user->comments as $gal) {
                if ($gal->replies->count() > 0) {
                    foreach ($gal->replies as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }

        if ($user->replies->count() > 0) {
            foreach ($user->replies as $gal) {
                if ($gal->subreplies->count() > 0) {
                    foreach ($gal->subreplies as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }


        if ($user->favorites->count() > 0) {
            foreach ($user->favorites as $gal) {
                $gal->delete();
            }
        }


        if ($user->subscribes->count() > 0) {
            foreach ($user->subscribes as $gal) {
                $gal->delete();
            }
        }

        if ($user->services->count() > 0) {
            foreach ($user->services as $gal) {
                if (file_exists(public_path().'/storage/images/services/'.$gal->photo)) {
                    unlink(public_path().'/storage/images/services/'.$gal->photo);
                }
                $gal->delete();
            }
        }


        if ($user->withdraws->count() > 0) {
            foreach ($user->withdraws as $gal) {
                $gal->delete();
            }
        }


        if ($user->products->count() > 0) {

// PRODUCT

            foreach ($user->products as $prod) {
                if ($prod->galleries->count() > 0) {
                    foreach ($prod->galleries as $gal) {
                        if (file_exists(public_path().'/storage/images/galleries/'.$gal->photo)) {
                            unlink(public_path().'/storage/images/galleries/'.$gal->photo);
                        }
                        $gal->delete();
                    }
                }
                if ($prod->ratings->count() > 0) {
                    foreach ($prod->ratings as $gal) {
                        $gal->delete();
                    }
                }
                if ($prod->wishlists->count() > 0) {
                    foreach ($prod->wishlists as $gal) {
                        $gal->delete();
                    }
                }

                if ($prod->clicks->count() > 0) {
                    foreach ($prod->clicks as $gal) {
                        $gal->delete();
                    }
                }

                if ($prod->comments->count() > 0) {
                    foreach ($prod->comments as $gal) {
                        if ($gal->replies->count() > 0) {
                            foreach ($gal->replies as $key) {
                                $key->delete();
                            }
                        }
                        $gal->delete();
                    }
                }

                if (file_exists(public_path().'/storage/images/products/'.$prod->photo)) {
                    unlink(public_path().'/storage/images/products/'.$prod->photo);
                }

                $prod->delete();
            }


            // PRODUCT ENDS
        }
        // OTHER SECTION



        if ($user->senders->count() > 0) {
            foreach ($user->senders as $gal) {
                if ($gal->messages->count() > 0) {
                    foreach ($gal->messages as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }


        if ($user->recievers->count() > 0) {
            foreach ($user->recievers as $gal) {
                if ($gal->messages->count() > 0) {
                    foreach ($gal->messages as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }


        if ($user->conversations->count() > 0) {
            foreach ($user->conversations as $gal) {
                if ($gal->messages->count() > 0) {
                    foreach ($gal->messages as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }


        if ($user->vendororders->count() > 0) {
            foreach ($user->vendororders as $gal) {
                $gal->delete();
            }
        }

        if ($user->notivications->count() > 0) {
            foreach ($user->notivications as $gal) {
                $gal->delete();
            }
        }


        // OTHER SECTION ENDS


        //If Photo Doesn't Exist
        if ($user->photo == null) {
            $user->delete();
            //--- Redirect Section
            $msg = __('Data Deleted Successfully.');
            return response()->json($msg);
            //--- Redirect Section Ends
        }
        //If Photo Exist
        if (file_exists(public_path().'/storage/images/users/'.$user->photo)) {
            unlink(public_path().'/storage/images/users/'.$user->photo);
        }
        $user->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** JSON Request
    public function withdrawdatatables()
    {
        $datas = Withdraw::where('type', '=', 'user')->orderBy('id', 'desc');
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                ->addColumn('email', function (Withdraw $data) {
                    $email = $data->user->email;
                    return $email;
                })
                ->addColumn('phone', function (Withdraw $data) {
                    $phone = $data->user->phone;
                    return $phone;
                })
                ->editColumn('status', function (Withdraw $data) {
                    $status = ucfirst($data->status);
                    return $status;
                })
                ->editColumn('amount', function (Withdraw $data) {
                    $sign = Currency::where('id', '=', 1)->first();
                    $amount = $sign->sign . round($data->amount * $sign->value, 2);
                    return $amount;
                })
                ->addColumn('action', function (Withdraw $data) {
                    $action = '<div class="action-list"><a data-href="' . route('admin-withdraw-show', $data->id) . '" class="view" data-toggle="modal" data-target="#modal1"> <i class="fas fa-eye"></i> ' . __('Details') . '</a>';
                    if ($data->status == "pending") {
                        $action .= '<a data-href="' . route('admin-withdraw-accept', $data->id) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="fas fa-check"></i> ' . __('Accept') . '</a><a data-href="' . route('admin-withdraw-reject', $data->id) . '" data-toggle="modal" data-target="#confirm-delete1"> <i class="fas fa-trash-alt"></i> ' . __('Reject') . '</a>';
                    }
                    $action .= '</div>';
                    return $action;
                })
                ->rawColumns(['name', 'action'])
                ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function withdraws()
    {
        return view('admin.user.withdraws');
    }

    //*** GET Request
    public function withdrawdetails($id)
    {
        $sign = Currency::where('id', '=', 1)->first();
        $withdraw = Withdraw::findOrFail($id);
        return view('admin.user.withdraw-details', compact('withdraw', 'sign'));
    }

    //*** GET Request
    public function accept($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        $data['status'] = "completed";
        $withdraw->update($data);
        //--- Redirect Section
        $msg = __('Withdraw Accepted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function reject($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        $account = User::findOrFail($withdraw->user->id);
        $account->affilate_income = $account->affilate_income + $withdraw->amount + $withdraw->fee;
        $account->update();
        $data['status'] = "rejected";
        $withdraw->update($data);
        //--- Redirect Section
        $msg = __('Withdraw Rejected Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
