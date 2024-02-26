'use strict'; 

/**
 * Represents a ResponsivenessHandler class that handles responsiveness-related tasks.
 * @class
 * 
 * Below javascript by Daniel Kruger - 10/01/2024
 */
class ResponsivenessHandler {
    constructor(element, options=null) {
        this.element = element;
        this.deviceWidth = window.innerWidth;
        this.options = options ?? this.setDefaultOptions();
        this.observer = undefined;
    }
    
    /**
     * Filters the elements based on the provided options.
     * @param {Object} filterOptions - The filter options.
     * @param {Array} filterOptions.element - The elements to filter.
     * @param {number} filterOptions.limit - The maximum number of elements to show.
     */
    filterElements = (filterOptions={
        element: null, 
        limit: null
    }) => {
        const { limit } = filterOptions;
        let element = filterOptions?.element ?? this.element;

        element.forEach((card, index) => 
            index >= limit 
                ? card.classList.add('d-none') 
                : card.classList.remove('d-none'));
    }
   
    /**
     * Enables the ResizeObserver for the specified observerBox element.
     * The ResizeObserver is used to track changes in the size of the observerBox element.
     * @param {Element} observerBox - The element to observe for size changes.
     * @returns {Object} - The current object instance.
     */
    enableObserver = (observerBox) => {
        this.observer = new ResizeObserver(entries => {
            const entryWidth = entries[0]?.contentRect.width;
            this.setDeviceWidth((window.innerWidth - entryWidth) + entryWidth);
            
            const { breakpoints, enableMobileSlider } = this.options;
            enableMobileSlider && this.wrapWidthSlider(this.element[0].parentNode);

            Object.entries(breakpoints).forEach(([limit, value]) => 
                this.deviceWidth >= limit && this.filterElements({ limit: value }));
        });

        observerBox && this.observer.observe(observerBox);
        return this;
    }

    /**
     * Wraps the slider element based on the device width.
     * it creates a new slider container and appends cloned cards to it.
     * If a wrapper element is provided, it replaces its content with the new slider container.
     * If the device width is greater than the lowest breakpoint,
     * it replaces the existing slider container with the original cards.
     * @param {HTMLElement} wrapper - The wrapper element to replace its content with the new slider container.
     */
    wrapWidthSlider = (wrapper) => {
        const { breakpoints } = this.options;
        const lowestBreakpoint = Object.keys(breakpoints).reduce((a, b) => breakpoints[a] < breakpoints[b] ? a : b);
            
        if (this.deviceWidth <= Number(lowestBreakpoint)) {
            const sliderContainer = document.createElement('div');
            sliderContainer.className = 'px-4 px-md-0 col-12 col-sm-sm-8 col-md-6 mx-auto mb-5';
            sliderContainer.id = 'bestseller_observer';
            
            this.element.forEach(card => {
                sliderContainer.appendChild(card.cloneNode(true));
            });

            if (wrapper) {
                wrapper.innerHTML = '';
                wrapper.appendChild(sliderContainer);
                
                // Configure best-sellers mobile slider here
                $(sliderContainer).owlCarousel({
                    items: 1,
                    loop: false,
                    nav: true,
                    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                    dots: true,
                    center: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: false,
                        },
                        460: {
                            nav: true
                        },
                        720: {
                            items: 2,
                            center: false,
                            nav: true,
                        }
                    } 
                });
            }
        } else  {
            const _ = document.querySelector('#bestseller_observer');

            if (_){
                _.replaceWith(...this.element);
            }
        }
    }

    /**
     * Converts an HTML element to an object representation.
     * @param {HTMLElement} elem - The HTML element to convert.
     * @returns {Object} - The object representation of the HTML element.
     */
    toObject = (elem) => {
        const obj = {};

        obj.tagName = elem.tagName.toLowerCase();
        obj.attributes = {};
        
        for (const { name, value } of elem.attributes)
            obj.attributes[name] = value;
        
        obj.children = [];
        for (const childNode of elem.childNodes) 
            if (childNode.nodeType === 1) 
                obj.children.push(this.toObject(childNode));
             else if (childNode.nodeType === 3 && childNode.textContent.trim().length > 0) 
                obj.text = childNode.textContent.trim();
       
        return obj;
    }

    /**
     * Handles options error by checking if any required option is missing or null.
     * Throws an error with the specified message if any required option is missing or null.
     *
     * @param {Object} options - The options object to be checked.
     * @param {string} message - The error message to be thrown if any required option is missing or null.
     * @throws {Error} If any required option is missing or null.
     */
    handleOptionsError = (options, message, optionalValues=[]) => {
         if (Object.entries(options).some(([key, value]) => !key in optionalValues || value === null)) 
            throw new Error(message);
    }

    setDeviceWidth = (newWidth) => {
        this.deviceWidth = newWidth;
    }

    /**
     * Sets the default options for the theme.
     * READ ME => MAKE CHANGES TO THIS BREAKPOINTS UNLESS YOU WANT TO OVERWRITE IT IN THE FUNCTION CALL
     * @returns {Object} The default options object.
     */
    setDefaultOptions = () => {
        return {
            breakpoints: {
                2454: 12,
                1654: 10,
                1334: 8,
                1012: 6,
                767: 4,
            },
            enableMobileSlider: true,
            mode: this.deviceWidth <= 991 
                ? { open: 'click', close: 'dblclick' } 
                : { open: "mouseover", close: 'mouseleave' },
        };
    }
}

class DropdownHandler extends ResponsivenessHandler {
    /**
     * Sets the filter capability based on the provided options.
     * @param {Object} filterOptions - The filter options.
     * @param {number} filterOptions.breakpoint - The breakpoint value.
     * @param {number} filterOptions.limit - The limit value.
     * @returns {void}
     * 
     * FIXME - This method is not working as expected.
     * 
     */
    setFilterCap = (filterOptions={
        breakpoint: null,
        limit: null,
    }) => {
        try {
            this.handleOptionsError(filterOptions, "Filter options must not be null.");
            const { breakpoint, limit, element } = filterOptions;

            this.deviceWidth < breakpoint && this.filterElements({limit, element}); 
            return this;
        } catch (error) {
            console.error(error);
            return;
        }
    }
    
    /**
     * Enables the mobile dropdown functionality.
     */
    enableMobileDropdown = () => {
        if (this.deviceWidth <= 992) {
            const menuElem = document.querySelectorAll('.cat-and-sub-grid .dropdown_list .link-area');

            menuElem.forEach(link => {
                link.addEventListener('click', e => {
                    e.preventDefault();

                    const childCategoryContainer = link.nextElementSibling;
                    const subcat = e.target.parentNode.parentNode;

                    if (childCategoryContainer.dataset.id === subcat.dataset.id) {         
                        const childcats = subcat.nextElementSibling;

                        menuElem.forEach(link => {
                            link.classList.add('active');
                        });

                        childcats.classList.remove('d-none');
                        childcats.classList.add('active');
                        $('.mainmenu-area .categories_menu_inner .categories_menu').addClass('pt-0');
                        

                        childcats.querySelector('.close-mobi').addEventListener('click', () => {
                            childcats.classList.add('d-none');
                            childcats.classList.remove('active');
                            $('.mainmenu-area .categories_menu_inner .categories_menu').removeClass('pt-0');
                            
                            menuElem.forEach(link => {
                                link.classList.remove('active');
                            });
                        });
                    }
                });
            });
        }
    }
    
    /**
     * Handles the mega menu functionality.
     * 
     * @param {HTMLElement} containerDiv - The container element for the mega menu.
     * @returns {Object} - The current object instance.
     */
    megaMenuHandler = (containerDiv) => {
        const categoryData = JSON.parse(localStorage.getItem('categories'));
        const { open, close } = this.options.mode;

        /**
         * Toggles the menu based on the target, menu, and tracker.
         * @param {Object} options - The options object.
         * @param {HTMLElement} options.target - The target element.
         * @param {jQuery} options.menu - The menu element.
         * @param {Array} options.tracker - The tracker array.
         */
        const toggleMenu = ({ target, menu, tracker }) => {
            if (!this.isMobile()) {
                menu.parent().on(close, (e) => {
                    e.preventDefault();
                    
                    menu.stop().slideUp('medium');
                    $(target).parent().removeClass('active');

                    tracker = [];
                });

                menu.stop().slideDown('medium');
                tracker.forEach((item, _) => {
                    $(`#${item}`).parent().removeClass('active');
                });

                $(target).parent().addClass('active');
            } else {
                if (target.id === tracker[tracker.length - 1] && tracker.length > 1) {
                    menu.stop().slideUp('medium');
                    $(target).parent().removeClass('active');
                    
                    tracker = [];

                    if (this.isMobile()) {
                        smoothScroll(75, 500, false);

                        $('body').css('overflowY', 'scroll');
                        document.documentElement.style.overflowY = 'scroll';
                    }
                } else { 
                    menu.stop().slideDown('medium');

                    tracker.forEach((item, _) => {
                        $(`#${item}`).parent().removeClass('active');
                    });

                    $(target).parent().addClass('active');
                }

            }
        }

        /**
         * Smoothly scrolls the window to a specified distance over a given duration.
         * @param {number} distance - The distance to scroll in pixels.
         * @param {number} duration - The duration of the scroll animation in milliseconds.
         * @param {boolean} [direction=true] - The direction of the scroll. Defaults to true (scroll down).
         */
        const smoothScroll = (distance, duration, direction=true) => {
            if (window.scrollY !== 0 && direction) {
                return; 
            }

            const start = window.scrollY;
            const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

            const scroll = () => {
                const currentTime = 'now' in window.performance ? performance.now() : new Date().getTime();
                const elapsed = currentTime - startTime;

                window.scroll(0, easeInOut(elapsed, start, direction ? distance : -distance, duration));

                if (elapsed < duration) {
                    requestAnimationFrame(scroll);
                }
            }

            const easeInOut = (t, b, c, d) => {
                t /= d / 2;
                if (t < 1)
                    return c / 2 * t * t + b;

                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }

            requestAnimationFrame(scroll);
        }

        if (categoryData) {
            let tracker = [];

            this.element.forEach(elem => {
                const menu = $(elem).parent().parent().next();

                elem.addEventListener(open, e => {
                    e.preventDefault();
                    const { target } = e;

                    tracker.unshift(target.id);
                    tracker.length > 2  && tracker.pop();

                    if (target.id === elem.id) {
                        containerDiv.innerHTML = '';

                        for (let [_, { name, route, subs_order_by }] of Object.entries(categoryData)) {
                            name = name.split(' ').join('');

                            if (name === target.id) {
                                const grid = $(menu.children().children()[0]);
                                const subCategoryCount = subs_order_by.length;
                                
                                !this.isMobile() && grid.css('grid-template-columns', subCategoryCount > 0 
                                     && subCategoryCount < 10 
                                        ? `repeat(${subCategoryCount}, 1fr)` 
                                        : 'repeat(10, 1fr)'
                                    );

                                containerDiv.innerHTML = this.renderCategory({ route, subs_order_by });
                                this.enableMobileDropdown();
                            }
                        }

                        if (this.isMobile()){
                            smoothScroll(75, 500);

                            $('body').css('overflowY', 'hidden');
                            document.documentElement.style.overflowY = 'hidden';
                        }

                        toggleMenu({ target, menu, tracker });
                    }
                });
            });  
        }

        return this;
    };

    /**
     * Renders the category based on the given parameters.
     * 
     * @param {Object} options - The options for rendering the category.
     * @param {Array} options.subs_order_by - The array of subcategories to render.
     * @param {boolean} [limit=false] - Whether to limit the number of subcategories rendered.
     * @returns {string} The rendered category content.
     */
    renderCategory = ({ subs_order_by }, limit=false) => {
        let content = '';        

        subs_order_by.forEach((subcat, index) => {
           if (index < 10) {
               content += `
                    <li class="${limit ? 'rx-child' : ''} dropdown_list mx-auto position-md-relative qntd w-100 pl-0 pl-md-2 pl-xl-0 d-flex flex-column justify-content-start align-items-start align-items-lg-center">
                        <div class="link-area  pb-0 pb-lg-2" data-id="${subcat.name}" style="width: ${subs_order_by.length}0%">
                            <span>
                                <a href="${subcat.route}" class='text-left text-uppercase d-none link-text d-lg-inline-block'>
                                    ${subcat.name} 
                                </a>
                                <a href="#" class='d-lg-none text-left text-uppercase link-text d-inline-block' >
                                    ${subcat.name} 
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </span>
                        </div> 
                        <ul data-id="${subcat.name}" class='d-none d-lg-flex w-100 text-left mobi'>
                                <div class='d-lg-none close-mobi'> <i class='fas fa-arrow-left'></i> Voltar</div>
                                <div class="categorie_sub_menu mx-auto" style="width: ${subs_order_by.length}0%">
                                    <ul class='d-flex flex-column flex-wrap w-100 m-auto'>
                `;

                const hasChildren = subcat.childs_order_by.length > 0; 
                hasChildren && subcat.childs_order_by.forEach((child, index) => {
                    if ((index + 1) > 10) 
                        return;
                    
                    content += `
                        <li class="w-100 text-left">
                            <a href="${child.route}">
                                ${child.name} 
                            </a>
                        </li>
                    `; 
                }); 
            
                content += `
                                <li class='see-all ${!hasChildren && 'd-none'}'>
                                    <a href="${subcat.route}">
                                        Ver Tudo
                                    </a>
                                </li>
                            </div>
                        </ul>    
                     </li>
                `;
            } 
        });

        return content;
    };

    /**
     * Converts an element or the default element to an object.
     * @param {HTMLElement} elem - The element to convert to an object.
     * @returns {Object} - The converted object.
     */
    getAsObject = (elem) => {
        return this.toObject(elem ?? this.element);
    }

    isMobile = () => {
        return window.innerWidth <= 991;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const bestsellerCards = document.querySelectorAll('.best-seller-feature');
    const bestSellersContainer = document.querySelector('#best-sellers-container');

    const categoryContainer = document.querySelector('.sub-categori .categori-item-area .row');
    const categoryCards = document.querySelectorAll('.sub-categori .categori-item-area .feat_card');
    
    const links = document.querySelectorAll('.categori_toggle > a');

    new ResponsivenessHandler(bestsellerCards)
        .enableObserver(bestSellersContainer);

    new DropdownHandler(links)
        .megaMenuHandler(document.querySelector('.cat-and-sub-grid'))
});


$(function ($) {
    "use strict";

    $(document).ready(function () {
        // Profile Dropdown
        $('.openperfil.my-dropdown').on('mouseover', function () {
            $('.openperfil.my-dropdown .my-dropdown-menu.profile-dropdown').stop().show(0);
        });
        $('.openperfil.my-dropdown').on('mouseout', function () {
            $('.openperfil.my-dropdown .my-dropdown-menu.profile-dropdown').stop().hide(0);
        });

        // Profile Dropdown
        $('.openstore.my-dropdown').on('mouseover', function () {
            $('.openstore.my-dropdown .my-dropdown-menu.profile-dropdown').stop().show(0);
        });
        $('.openstore.my-dropdown').on('mouseout', function () {
            $('.openstore.my-dropdown .my-dropdown-menu.profile-dropdown').stop().hide(0);
        });

        $(function () {

            var url = window.location.href,
                urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");

            // now grab every link from the navigation
            $('.core-nav-list li a').each(function () {
                // and test its normalized href against the url pathname regexp
                if (url == this.href) {
                    $(this).addClass('active');
                }
            });

        });

        /*------addClass/removeClass categories-------*/
        var w = window.innerWidth;

        if (w > 991) {
            $("body").find(".horizontal").show();
            $("body").find(".vertical").hide();

            
            /*categories slideToggle*/
            $(".categori_toggle").on("mouseover", function () {
                
            });

            // $('.categories_menu_inner').on('mouseleave', function () {
            //     $('.categorimenu-wrapper').on('mouseleave', function() {
            //         $('.categories_menu_inner').stop().slideUp('medium');
            //         $('.categori_toggle').removeClass('active');
            //     });
            // });

            /*------addClass/removeClass categories-------*/
            $(".categories_menu_inner_horizontal > ul > li").on("mouseover", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').addClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });
            $(".categories_menu_inner > ul > li").on("mouseover", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').addClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });




            $(document).on('mouseover', function (e) {
                var container = $(".categories_menu_inner_horizontal,.categories_menu_inner, .categories_menu, .categori_toggle, .cat-and-sub-grid, .non-subs");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    // $('.categories_menu_inner').stop().slideUp('medium');
                    $('.categories_mega_menu, .categorie_sub').removeClass('open');
                    $(".categories_mega_menu").removeClass('open');
                    $(".categories_toggle").removeClass('active');
                }
            });
        }

        /*------addClass/removeClass categories-------*/


        if (w <= 991) {
            $("body").find(".horizontal").hide();
            $("body").find(".vertical").show();


            $(".categori_toggle").on("click", function () {
                // $(this).toggleClass('active');
                // $('.categories_menu_inner').stop().slideToggle('medium');

                var divs = $('.qntd');
                var qtd = divs.length;

                if (qtd > 9) {
                    $('.categories_mega_menu').addClass('dropup');
                }
            });

            /*------addClass/removeClass categories-------*/
            $(".categories_menu_inner > ul > li").on("click", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').toggleClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });
            $(".categories_menu_inner_horizontal > ul > li").on("click", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').toggleClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });


            $(document).on('click', function (e) {
                var container = $(".categories_menu_inner_horizontal,.categories_menu_inner, .categories_menu, .categories_title, .cat-and-sub-grid, .non-subs");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.categories_menu_inner').stop().slideUp('medium');
                    $('.categories_mega_menu, .categorie_sub').removeClass('open');
                    $(".categories_mega_menu").removeClass('open');
                    $(".categories_title").removeClass('active');
                }
            });

            $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").on('click', function () {
                $(this).find('i').toggleClass('fa-plus').toggleClass('fa-minus');
            });

            $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").each(function () {
                $(this).html('<i class="fas fa-plus"></i>');
            });

        }

        /*------addClass/removeClass categories-------*/



        $('nav').coreNavigation({
            menuPosition: "right",
            container: false,
            dropdownEvent: 'hover',
            onOpenDropdown: function () {
                console.log('open');
            },
            onCloseDropdown: function () {
                console.log('close');
            }
        });

        // Nice Select Start
        $('select.nice').niceSelect();

        $('#example').DataTable({
            "paging": true,
            "ordering": false,
            "info": true,
            "language": {
                "url": datatable_translation_url
            }
        });


        //   magnific popup
        $('.video-play-btn').magnificPopup({
            type: 'video'
        });



        // Tooltip Section

        $('[data-toggle="tooltip"]').tooltip({

        });

        $('[rel-toggle="tooltip"]').tooltip();

        $('[data-toggle="tooltip"]').on('click', function () {
            $(this).tooltip('hide');
        })


        $('[rel-toggle="tooltip"]').on('click', function () {
            $(this).tooltip('hide');
        })

        // Tooltip Section Ends

        /*-----------------------------
            Accordion Active js
        -----------------------------*/
        $("#accordion, #accordion2").accordion({
            heightStyle: "content",
            collapsible: true,
            icons: {
                "header": "ui-icon-caret-1-e",
                "activeHeader": " ui-icon-caret-1-s"
            }
        });
        $("#product-details-tab").tabs();


        // Hero Area Slider
        var $mainSlider = $('.intro-carousel');
        if ($('.intro-content').length > 1) {
            $mainSlider.owlCarousel({
                loop: true,
                navText: ['<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>'],
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 8000,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 500,
                onInitialized: startProgressBar,
                onTranslate: resetProgressBar,
                onTranslated: startProgressBar,
                responsive: {
                    0: {
                        dots: false,
                        items: 1
                    },
                    768: {
                        // nav: true,
                        items: 1
                    }
                },

            });
        }

        if ($('.intro-content').length > 1) {
            var $currentItem = $('.owl-item', $mainSlider).eq(2);
            var $class1 = $currentItem.find('.subtitle').attr('data-animation');
            $currentItem.find('.subtitle').addClass($class1);
            setTimeout(function () {
                $currentItem.find('.subtitle').removeClass($class1);
            }, 900);

            var $class2 = $currentItem.find('.title').attr('data-animation');
            $currentItem.find('.title').addClass($class2);
            setTimeout(function () {
                $currentItem.find('.title').removeClass($class2);
            }, 900);

            var $class3 = $currentItem.find('.text').attr('data-animation');
            $currentItem.find('.text').addClass($class3);
            setTimeout(function () {
                $currentItem.find('.text').removeClass($class3);
            }, 900);

        }




        if ($('.intro-content').length > 1) {

            $mainSlider.on('changed.owl.carousel', function (event) {
                var $currentItem = $('.owl-item', $mainSlider).eq(event.item.index)

                var $class11 = $currentItem.find('.subtitle').attr('data-animation');
                $currentItem.find('.subtitle').addClass($class11);
                setTimeout(function () {
                    $currentItem.find('.subtitle').removeClass($class11);
                }, 900);

                var $class22 = $currentItem.find('.title').attr('data-animation');
                $currentItem.find('.title').addClass($class22);
                setTimeout(function () {
                    $currentItem.find('.title').removeClass($class22);
                }, 900);
                var $class33 = $currentItem.find('.text').attr('data-animation');
                $currentItem.find('.text').addClass($class33);
                setTimeout(function () {
                    $currentItem.find('.text').removeClass($class33);
                }, 900);


            });

        }



        function startProgressBar() {
            // apply keyframe animation
            $(".slide-progress").css({
                width: "100%",
                transition: "width 8000ms"
            });
        }

        function resetProgressBar() {
            $(".slide-progress").css({
                width: 0,
                transition: "width 0s"
            });
        }
        // Hero Area Slider End





        // flas_deal_slider
        var $flas_deal_slider = $('.flas-deal-slider');

        if ($flas_deal_slider.children().length > 1) {
            $flas_deal_slider.owlCarousel({
                items: 5,
                loop: true,
                nav: true,
                navText: ['<i class=" fas fa-arrow-alt-circle-left"></i>', '<i class="fas fa-arrow-alt-circle-right"></i>'],
                margin: 5,
                autoplay: true,
                autoplayTimeout: 6000,
                smartSpeed: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    414: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 5
                    }
                }
            });

        }



        // Product deal countdown
        $('[data-countdown]').each(function () {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                $this.html(event.strftime('<span>%D : <small>Dias</small></span> <span>%H : <small>Hrs</small></span>  <span>%M : <small>Min</small></span> <span>%S <small>Seg</small></span>'));
            });
        });

        // trending item  slider
        const $trending_slider = $('.trending-item-slider');
        $trending_slider.owlCarousel({
            loop: false,
            nav: false,
            dots: true,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            center: false,
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                },
                620: {
                    items: 2,
                },
                768: {
                    items: 3,
                    nav: true,
                },
                // 992: {
                //     items: 3,
                // },
                1200: {
                    items: 4,
                },
            }
        });


        // trending item  slider
        var $hot_new_slider = $('.hot-and-new-item-slider');

        // fix not looping when just having 1 item.
        // source: https://github.com/OwlCarousel2/OwlCarousel2/issues/548#issuecomment-74332563
        $hot_new_slider.each(function () {
            if ($(this).find('.item-slide').length > 1) {
                $(this).owlCarousel({
                    // items: 2,
                    autoplay: false,
                    margin: 5,
                    loop: true,
                    dots: false,
                    nav:true,
                    center: false,
                    autoplayHoverPause: true,
                    navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
                    smartSpeed: 800,
                    responsive: {
                        0: {
                            items: 1
                        },
                        720: {
                            items: 2,
                        },
                        1880: {
                            items: 3,
                        }
                    }
                })
            }
        });

        // trending item  slider
        var $hot_new_slider = $('.hot-and-new-item-slider-page-product');

        // fix not looping when just having 1 item.
        // source: https://github.com/OwlCarousel2/OwlCarousel2/issues/548#issuecomment-74332563
        $hot_new_slider.each(function () {
            if ($(this).find('.item-slide').length > 1) {
                $(this).owlCarousel({
                    items: 1,
                    autoplay: true,
                    margin: 0,
                    loop: true,
                    nav: true,
                    center: false,
                    autoplayHoverPause: true,
                    navText: ['<i class="fas fa-arrow-alt-circle-left"></i>', '<i class="fas fa-arrow-alt-circle-right"></i>'],
                    smartSpeed: 800,
                })
            }
        });

        //service slider
        var $service_slider = $('#services-carousel'),
            $w = $(window).width();

        // fix not looping when just having 1 item.
        // source: https://github.com/OwlCarousel2/OwlCarousel2/issues/548#issuecomment-74332563
        if ($w > 768) {
            $service_slider.each(function () {
                if ($(this).find('.item-slide').length >= 3) {
                    $(this).owlCarousel({
                        items: 3,
                        autoplay: true,
                        margin: 0,
                        loop: false,
                        dots: false,
                        nav: false,
                        center: true,
                        autoplayHoverPause: true,
                        navText: ['<i class="fas fa-arrow-alt-circle-left"></i>', '<i class="fas fa-arrow-alt-circle-right"></i>'],
                        autoplayTimeout:6000,
                        smartSpeed: 800,
                        responsive: {
                            0: {
                                items: 1,
                            },
                            992: {
                                items: 2,
                                center: false,
                            },
                            1200: {
                                items: 3,
                                center: false,
                            }
                        }
                    })
                }
            });
        } else {
            $service_slider.owlCarousel({
                items: 1,
                autoplay: true,
                margin: 0,
                loop: true,
                dots: false,
                nav: false,
                center: true,
                autoplayHoverPause: true,
                navText: [''],
                smartSpeed: 800,
            });
        }


        $(document).on('click', function (e) {
            var container = $(".autocomplete-items");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $(".autocomplete").hide();
            }
        });

        if (w <= 991) {

            $(document).on('mouseover', function (e) {
                var container = $(".xzoom-preview");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $(".xzoom-preview").css('display', 'none');
                }
            });

        }

        if (w <= 991) {

            $('.carticon').on('click', function () {
                $(this).next().toggleClass('show');
            });

            $(document).on('click', function (e) {
                var container = $(".carticon, .my-dropdown-menu");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.my-dropdown-menu').removeClass('show');
                }
            });
        }



    });

    // aside_review_slider
    var $aside_review_slider = $('.aside-review-slider');

    if ($aside_review_slider.children().length > 1) {

        $aside_review_slider.owlCarousel({
            loop: true,
            nav: false,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            dots: true,
            autoplay: true,
            autoplayTimeout: 6000,
            smartSpeed: 1000,
            center: false,
            responsive: {
                0: {
                    items: 1,
                    margin: 20,
                },
                768: {
                    items: 1,
                    nav: true,
                    center: true,
                }
            }
        });

    }





    /*-------------------------------
        back to top
    ------------------------------*/
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 1000);
    });

    //define variable for store last scrolltop
    $(window).on('scroll', function () {
        var $window = $(window);

        if ($(window).width() > 991) {

            if ($window.scrollTop() > 45) {
                $(".menufixed").addClass('nav-fixed');

                var tamanhomenu = $('.nav-fixed').height() + $('.top-header').height() + 20;

                $('.breadcrumb-area').css('margin-top', tamanhomenu);

            } else {
                $(".menufixed").removeClass('nav-fixed');

                var tamanhomenu = $('.nav-fixed').height();

                $('.breadcrumb-area').css('margin-top', '');
            }
        } else {
            if ($window.scrollTop() > 190) {
                $(".mainmenu-area").addClass('nav-fixed');

            } else {
                $(".mainmenu-area").removeClass('nav-fixed');
            }
        }


        /*---------------------------
            back to top show / hide
        ---------------------------*/
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        var lastScrollTop = st;

    });

    $(window).on('load', function () {

        /*---------------------
            Preloader
        -----------------------*/
        var preLoder = $("#preloader");
        preLoder.addClass('hide');
        var backtoTop = $('.back-to-top')
        /*-----------------------------
            back to top
        -----------------------------*/
        var backtoTop = $('.bottomtotop')
        backtoTop.fadeOut(100);
    });

    // Coupon code toggle code
    $('#coupon-link').on('click', function () {
        $("#coupon-form,#check-coupon-form").toggle();
    })

    $('.preload-close').click(function () {
        $('.subscribe-preloader-wrap').hide();
    });

    $(window).load(function () {
        setTimeout(function () {
            $('#subscriptionForm').show();
        }, 2000)
    });


    // partner-slider
    var $partner_Slider = $('.partner-slider');
    $partner_Slider.owlCarousel({
        loop: true,
        dots: true,
        autoplay: true,
        margin: 30,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            767: {
                items: 3
            },
            993: {
                items: 5
            }
        }
    });

    const $brandSlider = $('.brands-slider');
    $brandSlider.owlCarousel({
        loop: true,
        nav: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        mouseDrag: true,
        touchDrag: true,
        dots: true,
        center: false,
        autoplay: true,
        smartSpeed: 1000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            756: {
                items:2,
                center: false,
            },
            1080: {
                items: 3,
            },
            1600: {
                items: 4,
            }
        }
    });


    var $product_slider = $('.all-slider');
    $product_slider.owlCarousel({
        loop: false,
        dots: false,
        nav: true,
        navText: ['<i class="fas fa-arrow-alt-circle-left"></i>', '<i class="fas fa-arrow-alt-circle-right"></i>'],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            }
        }
    });

    var $product_color_gallery_slider = $('.all-slider-color-gallery');
    $product_color_gallery_slider.owlCarousel({
        touchDrag: false,
        mouseDrag: false,
        loop: false,
        dots: false,
        nav: false,
        navText: ['<i class="fas fa-arrow-alt-circle-left"></i>', '<i class="fas fa-arrow-alt-circle-right"></i>'],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            }
        }
    });


    var $product_material_gallery_slider = $('.all-slider-material-gallery');
    $product_material_gallery_slider.owlCarousel({
        touchDrag: false,
        mouseDrag: false,
        loop: false,
        dots: false,
        nav: false,
        navText: ['<i class="fa-solid fa-circle-arrow-left"></i>', '<i class="fa-solid fa-circle-arrow-right"></i>'],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            }
        }
    });

    $(document).on('submit', '#subscribeform', function (e) {
        e.preventDefault();
        $('#sub-btn').prop('disabled', true);
        $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ((data.errors)) {
                    toastr.error(data['error']);
                } else {
                    toastr.success(data['success']);
                    $('.preload-close').click()
                }

                $('#sub-btn').prop('disabled', false);


            }

        });

    });
    $(document).on('submit', '#subscribeform2', function (e) {
        e.preventDefault();
        $('#sub-btn').prop('disabled', true);
        $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ((data.errors)) {
                    toastr.error(data['error']);
                } else {
                    toastr.success(data['success']);
                    $('.preload-close').click()
                }

                $('#sub-btn').prop('disabled', false);
            }
        });
    });

    $('.feature_slidee').owlCarousel({
        loop: false,
        nav: true,
        dots: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        center: false,
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            460: {
                items: 2,
                nav: false,
            },
            768: {
                items: 3,
                nav: true,
            },
            992: {
                items: 4,
                nav: true,
            },
            1320: {
                items: 5,
                nav: true,
            },
        }
    })

    $('.slidee').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
});
