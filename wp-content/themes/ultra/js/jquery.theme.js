/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */
jQuery( function( $ ) { 

    // FitVids.
    if ( typeof $.fn.fitVids !== 'undefined' ) {
        $( '.entry-content, .entry-content .panel, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
    };  

    // Main menu.
    var isPrimaryMaxMegaMenu = $('.main-navigation .mega-menu-wrap').length;
    if ( ! isPrimaryMaxMegaMenu ) {
        function ultraNavMenu() {
            if ( ( isResponsiveMenu && ( $( window ).width() > ultra_resp_menu_params.collapse )) || ! isResponsiveMenu ) {
                $( '.site-header' )
                    .on( 'mouseenter', '.main-navigation ul li', function() {
                        var $$ = $( this);
                        var $ul = $$.find( '> ul' );
                        $ul.css( {
                            'display' : 'block',
                            'opacity' : 0
                        } ).clearQueue().animate( { opacity: 1 }, 250 );
                        $ul.data( 'final-opacity', 1 );
                    } )
                    .on( 'mouseleave', '.main-navigation ul li', function() {
                        var $$ = $( this );
                        var $ul = $$.find( '> ul' );
                        $ul.clearQueue().animate( { opacity: 0 }, 250, function() {
                            if( $ul.data( 'final-opacity' ) == 0) {
                                $ul.css( 'display', 'none' );
                            }
                        } );
                        $ul.data( 'final-opacity', 0 );
                    } );
                return false;
            }
            else {
                $( '.site-header' ).off( 'mouseenter mouseleave' ).on( 'mouseenter mouseleave' );
            }
            $( '.sub-menu' ).removeAttr( 'style' );
        }

        // Call function on load and page resize.
        $( window ).load( ultraNavMenu );
        $( window ).resize( ultraNavMenu );
    }

    // Main menu current menu item indication.
    jQuery( document ).ready( function( $ ) {
        if ( window.location.hash ) {
            return;
        } else {
            $( '#site-navigation a[href="'+ window.location.href +'"]' ).parent( 'li' ).addClass( 'current-menu-item' );
        }
        $( window ).scroll( function() {
            if ( $( '#site-navigation ul li' ).hasClass( 'current' ) ) {
               $( '#site-navigation li' ).removeClass( 'current-menu-item' ); 
            }
        } );
    } ); 

    // Main menu search bar.
    var isSearchHover = false;
    $( document ).click( function() {
        if ( ! isSearchHover ) $( '.main-navigation .menu-search .search-form' ).fadeOut( 250 );
    } );

    $( document )
        .on( 'click','.search-icon', function() {
            var $$ = $( this ).parent();
            $$.find( 'form' ).fadeToggle( 250 );
            setTimeout( function() {
                $$.find( 'input[name=s]' ).focus();
            }, 300);
        } );

    $( document )
        .on( 'mouseenter', '.search-icon', function() {
            isSearchHover = true;
        } )
        .on( 'mouseleave', '.search-icon', function() {
            isSearchHover = false;
        } );             

    // Main slider flexslider initialize.
    $('.entry-content .flexslider:not(.metaslider .flexslider), #metaslider-demo.flexslider').flexslider( {
        namespace: "flex-ultra-",        
    } );  

    // Main slider stretch.
    $('body.full #main-slider[data-stretch="true"]').each(function(){
        var $$ = $(this);
        $$.find('>div').css('max-width', '100%');
        $$.find('.slides li').each(function(){
            var $s = $(this);

            // Move the image into the background.
            var $img = $s.find('img.ms-default-image').eq(0);
            if(!$img.length) {
                $img = $s.find('img').eq(0);
            }

            $s.css('background-image', 'url(' + $img.attr('src') + ')');
            $img.css('visibility', 'hidden');
            // Add a wrapper.
            $s.wrapInner('<div class="container"></div>');
            // This is because IE doesn't detect links correctly when we stretch slider images.
            var link = $s.find('a');
            if(link.length) {
                $s.mouseover(function () {
                    $s.css('cursor', 'hand');
                });
                $s.mouseout(function () {
                    $s.css('cursor', 'pointer');
                });
                $s.click(function ( event ) {
                    event.preventDefault();
                    var clickTarget = $(event.target);
                    var navTarget = clickTarget.is('a') ? clickTarget : link;
                    window.open( navTarget.attr( 'href' ), navTarget.attr( 'target' ) );
                });
            }
        });
    });       

    // Retina images.
    var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
    if( pixelRatio > 1 ) {
        $('img[data-retina-image]').each(function(){
            var $$ = $(this);
            $$.attr('src', $$.data('retina-image'));

            // If the width attribute isn't set, then lets scale to 50%.
            if( typeof $$.attr('width') == 'undefined' ) {
                $$.load( function(){
                    var size = [$$.width(), $$.height()];
                    $$.width(size[0]/2);
                    $$.height(size[1]/2);
                } );
            }
        })
    }

    // Scroll to top.
    var isMobileDevice = $( 'body' ).hasClass( 'ultra-mobile-device' ),
        isMobileScrollTop = $( 'body' ).hasClass( 'mobile-scroll-top' );

    if ( ( ! isMobileDevice && $( '#scroll-to-top' ).hasClass( 'scroll-to-top' ) ) || ( isMobileDevice && isMobileScrollTop ) ) {

        $( window ).scroll( function() {
            if ( $( window ).scrollTop() > 150) {
                $( '#scroll-to-top' ).addClass( 'displayed' );
            }
            else {
                $( '#scroll-to-top' ).removeClass( 'displayed' );
            }
        } );

        $( '#scroll-to-top' ).click( function() {
            $( "html, body" ).animate( { scrollTop: "0px" } );
            return false;
        } );
    }      

    // Sticky header.
    var isHeaderScaling = $( 'header' ).hasClass( 'scale' ),
        isMobileDevice = $( 'body' ).hasClass( 'ultra-mobile-device' ),
        isMobileStickyHeader = $( 'body' ).hasClass( 'mobile-sticky-header' ),
        isResponsiveMenu = $( 'header' ).hasClass( 'responsive-menu' ),
        isStickyHeader = $( 'header' ).hasClass( 'sticky-header' );
        isAdminBar = $( 'body' ).hasClass( 'admin-bar' ),
        adminBarHeight = $( '#wpadminbar' ).outerHeight();    
    if ( ( isStickyHeader && ! isMobileDevice ) || ( isStickyHeader && isMobileDevice && isMobileStickyHeader ) ) {     
        $( '.site-header' ).hcSticky( {
            responsive: false,
            className: 'is-stuck',
         } ); 

        if ( isHeaderScaling ) {
           $( window ).scroll( function() {
                if ( $( this ).scrollTop() > 150 ) {
                    $( '.site-header' ).addClass( 'scaled' );
                } else {
                    $( '.site-header' ).removeClass( 'scaled' );
                }
            } );  
        }                 
    }

    // Smooth scroll.
    if ( ultra_smooth_scroll_params.value ) {

        jQuery( document ).ready( function() {
            jQuery( '#site-navigation a[href*="#"]:not( [href="#"] ), .puro-scroll[href*="#"]:not( [href="#"] )' ).bind( 'click', function() {

                // Header height.
                if ( isStickyHeader && isAdminBar ) {
                    if ( isHeaderScaling ) {
                        var headerHeight = adminBarHeight + 72;
                    } else {
                        var headerHeight = adminBarHeight + $( 'header' ).height() - 3;
                    }
                } else if ( isStickyHeader ) {
                    if ( isHeaderScaling ) {
                        var headerHeight = 72;
                    } else {
                        var headerHeight = $( 'header' ).height() - 3;
                    }                    
                } else {
                    var headerHeight = 0;
                }

                var hash    = this.hash;
                var idName  = hash.substring( 1 );      // Get ID name.
                var alink   = this;                     // This button pressed.

                $( 'header *' ).removeClass( 'toggled' );

                // Check if there is a section that had same id as the button pressed.
                if ( jQuery( '.panel-grid [id*=' + idName + ']' ).length > 0 ) {
                    jQuery( '#site-navigation .current' ).removeClass( 'current' );
                    jQuery( alink ).parent( 'li' ).addClass( 'current' );
                } else {
                    jQuery( '#site-navigation .current' ).removeClass( 'current' );
                }
                if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
                    var target = jQuery( this.hash );
                    target = target.length ? target : jQuery( '[name=' + this.hash.slice(1) +']' );
                    if ( target.length ) {
                        jQuery( 'html, body' ).animate( {
                            scrollTop: target.offset().top - headerHeight
                        }, 1200 );
                        return false; 
                    }
                }
            } );
            $( 'html, body' ).animate( { scrollTop: '0' } );
        } ); 

        jQuery( window ).load( function() {

            // Header height.
            if ( isStickyHeader && isAdminBar ) {
                if ( isHeaderScaling ) {
                    var headerHeight = adminBarHeight + 72;
                } else {
                    var headerHeight = adminBarHeight + $( 'header' ).height() - 3;
                }
            } else if ( isStickyHeader ) {
                if ( isHeaderScaling ) {
                    var headerHeight = 72;
                } else {
                    var headerHeight = $( 'header' ).height() - 3;
                }                    
            } else {
                var headerHeight = 0;
            }

            // jQuery( '#site-navigation .current' ).removeClass( 'current' );
            // jQuery( '#site-navigation a[href$="' + window.location.hash + '"]').parent( 'li' ).addClass( 'current' );
            if ( location.pathname.replace( /^\//,'' ) == window.location.pathname.replace( /^\//,'' ) && location.hostname == window.location.hostname ) {
                var target = jQuery( window.location.hash );
                if ( target.length ) {
                    jQuery( 'html, body' ).animate( {
                        scrollTop: target.offset().top - headerHeight
                    }, 1200 );
                    return false;
                }
            }
        } );
    } // ultra_smooth_scroll_params.value

    // Main navigation selected menu classes.
    function ultraScrolled() {  

        // Cursor position.
        var scrollTop = jQuery( window ).scrollTop();        

        // Header height.
        if ( isStickyHeader && isAdminBar ) {
            if ( isHeaderScaling ) {
                var headerHeight = adminBarHeight + 76;
            } else {
                var headerHeight = adminBarHeight + $( 'header' ).height();
            }
        } else if ( isStickyHeader ) {
            if ( isHeaderScaling ) {
                var headerHeight = 76;
            } else {
                var headerHeight = $( 'header' ).height();
            }                    
        } else {
            var headerHeight = 0;
        }

        // Used for checking if the cursor is in one section or not.
        var isInOneSection = 'no';                                        

        // For all sections check if the cursor is inside a section.
        jQuery( ".panel-grid" ).each( function() {

            // Section ID.
            var thisID = '#' + jQuery( this ).attr( 'id' );    

            // Distance between top and our section.                 
            var offset = jQuery( this ).offset().top;     

            // Section height.                      
            var thisHeight = jQuery( this ).outerHeight();                     
            
            // Where the section begins.
            var thisBegin = offset - headerHeight;
                  
            // Where the section ends.                            
            var thisEnd = offset + thisHeight - headerHeight;               

            // If position of the cursor is inside of the this section.
            if ( scrollTop >= thisBegin && scrollTop <= thisEnd ) {
                jQuery( '#site-navigation .current' ).removeClass( 'current' );
                // Find the menu button with the same ID section.
                jQuery( '#site-navigation a[href$="' + thisID + '"]' ).parent('li').addClass( 'current' );
                return false;
            }
            if ( isInOneSection == 'no' ) {
                jQuery( '#site-navigation .current' ).removeClass( 'current' );
            }
        } );
    }

    jQuery( window ).on( 'scroll', ultraScrolled );    

    // Top bar menu.
    var isTopBarMaxMegaMenu = $( '.top-bar-navigation .mega-menu-wrap' ).length;
    if ( ! isTopBarMaxMegaMenu ) {
        $('#top-bar')
            .on('mouseenter', '.top-bar-navigation ul li', function(){
                var $$ = $(this);
                var $ul = $$.find('> ul');
                $ul.css({
                    'display' : 'block',
                    'opacity' : 0
                }).clearQueue().animate({opacity: 1}, 250);
                $ul.data('final-opacity', 1);
            } )
            .on('mouseleave', '.top-bar-navigation ul li', function(){
                var $$ = $(this);
                var $ul = $$.find('> ul');
                $ul.clearQueue().animate( {opacity: 0}, 250, function(){
                    if($ul.data('final-opacity') == 0) {
                        $ul.css('display', 'none');
                    }
                });
                $ul.data('final-opacity', 0);
            } );
    }

    // Top bar responsive behaviour.
    if( $('body').hasClass('resp') && $('body').hasClass('resp-top-bar') ) {
        function ultrahidingHeader( selector, breakpointWidth ) {
            return {
                _selector: selector,
                _breakpointWidth: breakpointWidth,
                _duration: 500,
                _firstRun: true,
                _forceToShow: false,
                _animating: false,
                _currentState: '',
                _startingState: '',
                _eventCb: { stateStart: false, stateEnd: false },

                _get: function() {
                    return $(this._selector);
                },
                _getState: function() {
                    if( window.innerWidth >= this._breakpointWidth ) return 'show';
                    if( this._forceToShow ) return 'force';
                    return 'hide';
                },
                _setNewState: function( newState, start ) {
                    if( this._currentState == newState ) return;
                    if( start ) {
                        if( this._startingState != newState ) {
                            this._startingState = newState;
                            if( this._eventCb.stateStart ) this._eventCb.stateStart( newState );
                        }
                    } else {
                        this._currentState = newState;
                        if( this._eventCb.stateEnd ) this._eventCb.stateEnd( newState );
                    }
                },
                _hide: function( animate ) {
                    var header = this._get();
                    var self = this;
                    var css = {
                        'margin-top': -header.height()+'px'
                    };
                    this._setNewState( 'hide', true );
                    if( animate ) {
                        this._animating = true;
                        header.animate( css, {
                            duration: this._duration,
                            step: function( now, fx ) {
                                if( -self._get().height() != fx.end ) fx.end = -self._get().height();
                            },
                            done: function() {
                                self._animating = false;
                                self._setNewState( 'hide' );
                                self.adjust();
                            }
                        });
                    } else {
                        header.css( css );
                        this._setNewState( 'hide' );
                    }
                },
                _show: function( animate ) {
                    var css = {
                        'margin-top': '0px'
                    };
                    var self = this;
                    var state = this._getState();
                    this._setNewState( state, true );
                    if( animate ) {
                        this._animating = true;
                        this._get().animate( css, {
                            duration: this._duration,
                            step: function( now, fx ) {
                                var margin = -self._get().height();
                                if( margin != fx.start ) fx.start = margin;
                            },
                            done: function() {
                                self._animating = false;
                                self._setNewState( state );
                                self.adjust();
                            }
                        });
                    } else {
                        this._get().css( css );
                        this._setNewState( state );
                    }
                },
                toggle: function() {
                    switch( this._currentState )
                    {
                        case 'force':
                            this._forceToShow = false;
                            break;
                        case 'hide':
                            this._forceToShow = true;
                            break;
                        default:
                            break;
                    }
                    this.adjust();
                },
                adjust: function() {
                    if( this._animating ) {
                        return this;
                    }
                    if( this._firstRun ) {
                        switch( this._getState() ) {
                            case 'hide': this._hide(); break;
                            default: this._show();
                        }
                        this._firstRun = false;
                    } else {
                        var state = this._getState();
                        switch( state ) {
                            case 'hide':
                                if( this._currentState == 'hide' ) this._hide();
                                else this._hide( true );
                                break;
                            default:
                                if( this._currentState == 'hide' ) this._show( true );
                                else if( this._currentState != state ) this._show();
                        }
                    }
                    return this;
                },
                getCurrentState: function() {
                    return this._currentState;
                },
                on: function( event, cb ) {
                    switch( event ) {
                        case 'statestart': this._eventCb.stateStart = cb; break;
                        case 'stateend': this._eventCb.stateEnd = cb; break;
                        default:
                            throw 'unknown event: '+event;
                    }
                    return this;
                }
            };
        };
    };

    if( $('body').hasClass('resp') && $('body').hasClass('resp-top-bar') ) {
        $(document).ready( function() {
            $('.top-bar-arrow').css( 'display', 'none' );
            var header = ultrahidingHeader( '#top-bar .container', ultra_resp_top_bar_params.collapse )
                .on( 'stateend', function( state ) {
                    switch( state ) {
                        case 'force':
                            $('.top-bar-arrow').removeClass( 'show' ).addClass( 'close' );
                            break;
                        case 'hide':
                            $('.top-bar-arrow').removeClass( 'close' ).addClass( 'show' );
                            break;
                        default:
                            $('.top-bar-arrow').removeClass( 'show' ).removeClass( 'close' );
                            break;
                    }
                })
                .on( 'statestart', function( state ) {
                    switch( state ) {
                        case 'force':
                            $('.top-bar-arrow').css( 'display', '' );
                            break;
                        case 'hide':
                            $('.top-bar-arrow').css( 'display', '' );
                            break;
                        default:
                            $('.top-bar-arrow').css( 'display', 'none' );
                            break;
                    }
                })
                .adjust();
            window.onresize = function() { header.adjust() };
            $('.top-bar-arrow').on( 'click', function() { header.toggle(); } );
        });
    };

    // Touch device. We detect this through ontouchstart, msMaxTouchPoints and MaxTouchPoints.
    if( 'ontouchstart' in document.documentElement || window.navigator.msMaxTouchPoints || window.navigator.MaxTouchPoints ) {
        $( 'body').removeClass( 'no-touch' );
    }
    if ( !$( 'body' ).hasClass( 'no-touch' ) ) {
        if ( /iPad|iPhone|iPod/.test( navigator.userAgent ) && !window.MSStream ) {
            $( 'body' ).css( 'cursor', 'pointer' );
        }
        $( '.site-navigation' ).find( '.menu-item-has-children > a' ).each( function() {
            $( this ).click( function(e){
                var link = $(this);
                e.stopPropagation();
                link.parent().addClass( 'touch-drop' );

                if( link.hasClass( 'hover' ) ) {
                    link.unbind( 'click' );
                } else {
                    link.addClass( 'hover' );
                    e.preventDefault();
                }

                $( '.site-navigation > .menu-item-has-children:not(.touch-drop) > a' ).click( function() {
                    link.removeClass('hover').parent().removeClass('touch-drop');
                } );

                $( document ).click( function() {
                    link.removeClass( 'hover' ).parent().removeClass( 'touch-drop' );
                } );

            } );
        } );
    }     

} );