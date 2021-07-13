<div class="header-navbar navbar-expand-sm navbar navbar-horizontal">
    <div class="main-menu-content mymain-menu-content">
        <aside class="main-horizontal-sidebar' {{ config('admin.layout.sidebar_style') }}">


            <div class="p-0 pl-1 pr-1">
                <ul class="nav nav-pills nav-sidebar" style="padding-top: 10px">
                    <style>
                        .fa-angle-left:before {
                            content: none!important;
                        }
                        .header-navbar .navbar-container ul.nav li>a.nav-link{
                            padding: 1rem .5rem 1rem 1rem!important;
                        }
                        .mymain-menu-content .nav-sidebar .menu-open>.nav-treeview{
                            display: none!important;
                        }
                    </style>

                    {!! admin_section(Dcat\Admin\Admin::SECTION['LEFT_SIDEBAR_MENU_TOP']) !!}

                    {!! admin_section(Dcat\Admin\Admin::SECTION['LEFT_SIDEBAR_MENU']) !!}

                    {!! admin_section(Dcat\Admin\Admin::SECTION['LEFT_SIDEBAR_MENU_BOTTOM']) !!}
                    <script>
                        var $content = $('.navbar-left').find('.main-menu-content');
                        var $items = $content.find('.nav-sidebar .nav-item');
                        var $menu = $('.main-menu .main-menu-content .main-sidebar .nav-sidebar');
                        $items.find('a').click(function (event,has_open) {
                            event.stopPropagation();
                            $menu.html('');
                            //有子类
                            if($(this).parent().hasClass('has-treeview')){

                                var li = $(this).siblings(".nav-treeview").find('.nav-item:eq(0)');
                                let i = 0;
                                while (true){
                                    let one = $(li).find('a').siblings(".nav-treeview").find('.nav-item:eq(0)');
                                    if(!one.length || i>6){
                                        break;
                                    }
                                    li = one;
                                    i++;
                                }
                                $(this).closest('li').siblings().find('a').removeClass('active');
                                if(!has_open){
                                    //$(li).find('a').addClass('active');
                                    //$(li).find('a').trigger('click','has_open');
                                    console.log($(li).find('a').attr('href'));
                                    if($(li).find('a').attr('href')){
                                        window.location.href=$(li).find('a').attr('href');
                                    }
                                    return;
                                }
                                //查找最顶级到父类

                                $menu.html($(this).parents('.has-treeview:last').find('.nav-treeview').html());
                                $(this).addClass('active');

                            }else{

                            }

                        });
                        $(function(){
                            //menu-open
                            var $openitems = $content.find('.nav-sidebar .menu-open');
                            if($openitems.length){
                                $openitems.find('a:eq(0)').trigger('click','has_open');
                                //$openitems.removeClass('menu-open');
                            }else{
                                $menu.html('');
                                $(this).addClass('active');
                            }

                        });



                    </script>
                </ul>
            </div>
        </aside>
    </div>
</div>