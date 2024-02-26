@if (count($extra_blogs) >= 1)
    <section class="blog-area">
        <div class="container">
            <div class="section-reviews">
                <h2 class="section-title">
                    {{ __('Recent On Our Blog') }}
                </h2>
            </div>

            <div class="carousel-blogs-items new-style-carousel owl-carousel owl-theme owl-loaded">
                @foreach ($extra_blogs->chunk(2) as $posts)
                    @foreach ($posts as $blogg)
                        <a href='{{ route('front.blogshow', $blogg->id) }}' class="item-blog">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="box-img-blog" style="background-image:url({{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }});"></div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                    <p class="date-blog">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="23" height="23" class="peopleIcon" fill="currentColor" viewBox="0 0 511.634 511.634" style="enable-background:new 0 0 511.634 511.634;" xml:space="preserve">
                                        <g>
                                            <path d="M482.513,83.942c-7.225-7.233-15.797-10.85-25.694-10.85h-36.541v-27.41c0-12.56-4.477-23.315-13.422-32.261   C397.906,4.475,387.157,0,374.591,0h-18.268c-12.565,0-23.318,4.475-32.264,13.422c-8.949,8.945-13.422,19.701-13.422,32.261v27.41   h-109.63v-27.41c0-12.56-4.475-23.315-13.422-32.261C178.64,4.475,167.886,0,155.321,0H137.05   c-12.562,0-23.317,4.475-32.264,13.422c-8.945,8.945-13.421,19.701-13.421,32.261v27.41H54.823c-9.9,0-18.464,3.617-25.697,10.85   c-7.233,7.232-10.85,15.8-10.85,25.697v365.453c0,9.89,3.617,18.456,10.85,25.693c7.232,7.231,15.796,10.849,25.697,10.849h401.989   c9.897,0,18.47-3.617,25.694-10.849c7.234-7.234,10.852-15.804,10.852-25.693V109.639   C493.357,99.739,489.743,91.175,482.513,83.942z M137.047,475.088H54.823v-82.23h82.224V475.088z M137.047,374.59H54.823v-91.358   h82.224V374.59z M137.047,264.951H54.823v-82.223h82.224V264.951z M130.627,134.333c-1.809-1.809-2.712-3.946-2.712-6.423V45.686   c0-2.474,0.903-4.617,2.712-6.423c1.809-1.809,3.946-2.712,6.423-2.712h18.271c2.474,0,4.617,0.903,6.423,2.712   c1.809,1.807,2.714,3.949,2.714,6.423v82.224c0,2.478-0.909,4.615-2.714,6.423c-1.807,1.809-3.946,2.712-6.423,2.712H137.05   C134.576,137.046,132.436,136.142,130.627,134.333z M246.683,475.088h-91.365v-82.23h91.365V475.088z M246.683,374.59h-91.365   v-91.358h91.365V374.59z M246.683,264.951h-91.365v-82.223h91.365V264.951z M356.323,475.088h-91.364v-82.23h91.364V475.088z    M356.323,374.59h-91.364v-91.358h91.364V374.59z M356.323,264.951h-91.364v-82.223h91.364V264.951z M349.896,134.333   c-1.807-1.809-2.707-3.946-2.707-6.423V45.686c0-2.474,0.9-4.617,2.707-6.423c1.808-1.809,3.949-2.712,6.427-2.712h18.268   c2.478,0,4.617,0.903,6.427,2.712c1.808,1.807,2.707,3.949,2.707,6.423v82.224c0,2.478-0.903,4.615-2.707,6.423   c-1.807,1.809-3.949,2.712-6.427,2.712h-18.268C353.846,137.046,351.697,136.142,349.896,134.333z M456.812,475.088h-82.228v-82.23   h82.228V475.088z M456.812,374.59h-82.228v-91.358h82.228V374.59z M456.812,264.951h-82.228v-82.223h82.228V264.951z"/>
                                        </g>
                                    </svg>
                                    {{ date('d', strtotime($blogg->created_at)) }}/{{ date('m', strtotime($blogg->created_at)) }}/{{ date('Y', strtotime($blogg->created_at)) }}
                                        </p>
                                        <h4 class="blog-title">
                                            {{ mb_strlen($blogg->title, 'utf-8') > 40 ? mb_substr($blogg->title, 0, 40, 'utf-8') . '...' : $blogg->title }}
                                        </h4>
                                        <!-- <div class="details mb-3 ">
                                            {!! substr(strip_tags($blogg->details), 0, 170) !!}
                                        </div> -->
                                        <h4 class="lermaisBlog">Confira no nosso blog</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    
                @endforeach
            </div>
        </div>
    </section>
@endif