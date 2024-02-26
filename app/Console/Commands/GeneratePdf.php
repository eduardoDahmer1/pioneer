<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class GeneratePdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate multiples PDF and Merge in only One to download all products in pdf format';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Storage::disk('public')->deleteDirectory('pdf/allPDFs');

        $currency = Currency::where('sign', 'U$')->first();
        $totalProducts = Product::where('status', 1)->select(['id', 'sku', 'external_name', 'photo', 'price', 'brand_id'])->lazy();
        $this->output->write('Starting generate products list PDF', true);
        $bar = $this->output->createProgressBar(Product::where('status', 1)->count());
        $bar->advance(0);
        $this->output->newLine();
        Log::info('Starting generate products list PDF');
        foreach ($totalProducts->chunk(1000) as $key => $products) {
            $pdf = Pdf::loadView('front.pdfview', ['products' => $products, 'currency' => $currency]);
            try {
                Storage::disk('public')->put('pdf/allPDFs/products-list-' . $key . '.pdf',  $pdf->output());
            } catch (\Throwable $th) {
                $this->output->write('Error in generating the pdf "products-list-' . $key . '.pdf"', true);
                Log::error('Error in generating the pdf "products-list-' . $key . '.pdf"', $th->getMessage());
                return 1;
            }
            $bar->advance(1000);
        }

        $allPDFs = Storage::disk('public')->allFiles('pdf/allPDFs');
        $oMerger = PDFMerger::init();

        try {

            foreach ($allPDFs as $pdfToMerge) {
                $oMerger->addPDF('storage/app/public/' . $pdfToMerge, 'all');
            }

            $oMerger->merge();
            $oMerger->save('storage/app/public/pdf/all-products-list.pdf');

            $this->output->newLine();
            $this->output->write('Success merged all PDF', true);
            Log::info('Success merged all PDF');
        } catch (\Throwable $th) {
            Log::error("Error on merging or save all pdf's", $th->getMessage());
            return 1;
        }

        return 0;
       
    }
}
