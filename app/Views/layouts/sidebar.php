<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>dist/index">Inventori</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>dist/index">In</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="<?= base_url(); ?>" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/layout_default">Default
                            Layout</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>dist/layout_transparent">Transparent
                            Sidebar</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>dist/layout_top_navigation">Top
                            Navigation</a></li>
                </ul>
            </li>
            <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/blank"><i class="far fa-square"></i>
                    <span>Blank Page</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_alert">Alert</a></li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_badge">Badge</a></li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_breadcrumb">Breadcrumb</a>
                    </li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_buttons">Buttons</a>
                    </li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_card">Card</a></li>
                    <li class=""><a class="nav-link"
                                    href="<?php echo base_url(); ?>dist/bootstrap_carousel">Carousel</a></li>
                    <li class=""><a class="nav-link"
                                    href="<?php echo base_url(); ?>dist/bootstrap_collapse">Collapse</a></li>
                    <li class=""><a class="nav-link"
                                    href="<?php echo base_url(); ?>dist/bootstrap_dropdown">Dropdown</a></li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_form">Form</a></li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_list_group">List
                            Group</a></li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_media_object">Media
                            Object</a></li>
                    <li class=""><a class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_modal">Modal</a></li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_nav' ? 'active' : ''; ?>"><a class="nav-link"
                                                                                                        href="<?php echo base_url(); ?>dist/bootstrap_nav">Nav</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_navbar' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_navbar">Navbar</a></li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_pagination' ? 'active' : ''; ?>"><a
                                class="nav-link"
                                href="<?php echo base_url(); ?>dist/bootstrap_pagination">Pagination</a></li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_popover' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_popover">Popover</a></li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_progress' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_progress">Progress</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_table' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_table">Table</a></li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_tooltip' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/bootstrap_tooltip">Tooltip</a></li>
                    <li class="<?php echo $first_uri_segment == 'bootstrap_typography' ? 'active' : ''; ?>"><a
                                class="nav-link"
                                href="<?php echo base_url(); ?>dist/bootstrap_typography">Typography</a></li>
                </ul>
            </li>
            <li class="menu-header">Stisla</li>
            <li class="dropdown <?php echo $first_uri_segment == 'components_article' || $first_uri_segment == 'components_avatar' || $first_uri_segment == 'components_chat_box' || $first_uri_segment == 'components_empty_state' || $first_uri_segment == 'components_gallery' || $first_uri_segment == 'components_hero' || $first_uri_segment == 'components_multiple_upload' || $first_uri_segment == 'components_pricing' || $first_uri_segment == 'components_statistic' || $first_uri_segment == 'components_tab' || $first_uri_segment == 'components_table' || $first_uri_segment == 'components_user' || $first_uri_segment == 'components_wizard' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Components</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $first_uri_segment == 'components_article' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_article">Article</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'components_avatar' ? 'active' : ''; ?>"><a
                                class="nav-link beep beep-sidebar"
                                href="<?php echo base_url(); ?>dist/components_avatar">Avatar</a></li>
                    <li class="<?php echo $first_uri_segment == 'components_chat_box' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_chat_box">Chat Box</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'components_empty_state' ? 'active' : ''; ?>"><a
                                class="nav-link beep beep-sidebar"
                                href="<?php echo base_url(); ?>dist/components_empty_state">Empty State</a></li>
                    <li class="<?php echo $first_uri_segment == 'components_gallery' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_gallery">Gallery</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'components_hero' ? 'active' : ''; ?>"><a
                                class="nav-link beep beep-sidebar" href="<?php echo base_url(); ?>dist/components_hero">Hero</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'components_multiple_upload' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_multiple_upload">Multiple
                            Upload</a></li>
                    <li class="<?php echo $first_uri_segment == 'components_pricing' ? 'active' : ''; ?>"><a
                                class="nav-link beep beep-sidebar"
                                href="<?php echo base_url(); ?>dist/components_pricing">Pricing</a></li>
                    <li class="<?php echo $first_uri_segment == 'components_statistic' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_statistic">Statistic</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'components_tab' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_tab">Tab</a></li>
                    <li class="<?php echo $first_uri_segment == 'components_table' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_table">Table</a></li>
                    <li class="<?php echo $first_uri_segment == 'components_user' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/components_user">User</a></li>
                    <li class="<?php echo $first_uri_segment == 'components_wizard' ? 'active' : ''; ?>"><a
                                class="nav-link beep beep-sidebar"
                                href="<?php echo base_url(); ?>dist/components_wizard">Wizard</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo $first_uri_segment == 'forms_advanced_form' || $first_uri_segment == 'forms_editor' || $first_uri_segment == 'forms_validation' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $first_uri_segment == 'forms_advanced_form' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/forms_advanced_form">Advanced
                            Form</a></li>
                    <li class="<?php echo $first_uri_segment == 'forms_editor' ? 'active' : ''; ?>"><a class="nav-link"
                                                                                                       href="<?php echo base_url(); ?>dist/forms_editor">Editor</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'forms_validation' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/forms_validation">Validation</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown <?php echo $first_uri_segment == 'gmaps_advanced_route' || $first_uri_segment == 'gmaps_draggable_marker' || $first_uri_segment == 'gmaps_geocoding' || $first_uri_segment == 'gmaps_geolocation' || $first_uri_segment == 'gmaps_marker' || $first_uri_segment == 'gmaps_multiple_marker' || $first_uri_segment == 'gmaps_route' || $first_uri_segment == 'gmaps_simple' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google Maps</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $first_uri_segment == 'gmaps_advanced_route' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_advanced_route">Advanced Route</a></li>
                    <li class="<?php echo $first_uri_segment == 'gmaps_draggable_marker' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_draggable_marker">Draggable Marker</a></li>
                    <li class="<?php echo $first_uri_segment == 'gmaps_geocoding' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_geocoding">Geocoding</a></li>
                    <li class="<?php echo $first_uri_segment == 'gmaps_geolocation' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_geolocation">Geolocation</a></li>
                    <li class="<?php echo $first_uri_segment == 'gmaps_marker' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_marker">Marker</a></li>
                    <li class="<?php echo $first_uri_segment == 'gmaps_multiple_marker' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_multiple_marker">Multiple Marker</a></li>
                    <li class="<?php echo $first_uri_segment == 'gmaps_route' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_route">Route</a></li>
                    <li class="<?php echo $first_uri_segment == 'gmaps_simple' ? 'active' : ''; ?>"><a
                                href="<?php echo base_url(); ?>dist/gmaps_simple">Simple</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo $first_uri_segment == 'modules_calendar' || $first_uri_segment == 'modules_chartjs' || $first_uri_segment == 'modules_datatables' || $first_uri_segment == 'modules_flag' || $first_uri_segment == 'modules_font_awesome' || $first_uri_segment == 'modules_ion_icons' || $first_uri_segment == 'modules_owl_carousel' || $first_uri_segment == 'modules_sparkline' || $first_uri_segment == 'modules_sweet_alert' || $first_uri_segment == 'modules_toastr' || $first_uri_segment == 'modules_vector_map' || $first_uri_segment == 'modules_weather_icon' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $first_uri_segment == 'modules_calendar' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_calendar">Calendar</a></li>
                    <li class="<?php echo $first_uri_segment == 'modules_chartjs' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_chartjs">ChartJS</a></li>
                    <li class="<?php echo $first_uri_segment == 'modules_datatables' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_datatables">DataTables</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'modules_flag' ? 'active' : ''; ?>"><a class="nav-link"
                                                                                                       href="<?php echo base_url(); ?>dist/modules_flag">Flag</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'modules_font_awesome' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_font_awesome">Font
                            Awesome</a></li>
                    <li class="<?php echo $first_uri_segment == 'modules_ion_icons' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_ion_icons">Ion Icons</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'modules_owl_carousel' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_owl_carousel">Owl
                            Carousel</a></li>
                    <li class="<?php echo $first_uri_segment == 'modules_sparkline' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_sparkline">Sparkline</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'modules_sweet_alert' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_sweet_alert">Sweet
                            Alert</a></li>
                    <li class="<?php echo $first_uri_segment == 'modules_toastr' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_toastr">Toastr</a></li>
                    <li class="<?php echo $first_uri_segment == 'modules_vector_map' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_vector_map">Vector Map</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'modules_weather_icon' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/modules_weather_icon">Weather
                            Icon</a></li>
                </ul>
            </li>
            <li class="menu-header">Pages</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url(); ?>dist/auth_forgot_password">Forgot Password</a></li>
                    <li><a href="<?php echo base_url(); ?>dist/auth_login">Login</a></li>
                    <li><a href="<?php echo base_url(); ?>dist/auth_register">Register</a></li>
                    <li><a href="<?php echo base_url(); ?>dist/auth_reset_password">Reset Password</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i> <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?php echo base_url(); ?>dist/errors_503">503</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>dist/errors_403">403</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>dist/errors_404">404</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>dist/errors_500">500</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo $first_uri_segment == 'features_activities' || $first_uri_segment == 'features_post_create' || $first_uri_segment == 'features_posts' || $first_uri_segment == 'features_profile' || $first_uri_segment == 'features_settings' || $first_uri_segment == 'features_setting_detail' || $first_uri_segment == 'features_tickets' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $first_uri_segment == 'features_activities' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/features_activities">Activities</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'features_post_create' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/features_post_create">Post
                            Create</a></li>
                    <li class="<?php echo $first_uri_segment == 'features_posts' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/features_posts">Posts</a></li>
                    <li class="<?php echo $first_uri_segment == 'features_profile' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/features_profile">Profile</a></li>
                    <li class="<?php echo $first_uri_segment == 'features_settings' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/features_settings">Settings</a>
                    </li>
                    <li class="<?php echo $first_uri_segment == 'features_setting_detail' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/features_setting_detail">Setting
                            Detail</a></li>
                    <li class="<?php echo $first_uri_segment == 'features_tickets' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/features_tickets">Tickets</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo $first_uri_segment == 'utilities_invoice' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url(); ?>dist/utilities_contact">Contact</a></li>
                    <li class="<?php echo $first_uri_segment == 'utilities_invoice' ? 'active' : ''; ?>"><a
                                class="nav-link" href="<?php echo base_url(); ?>dist/utilities_invoice">Invoice</a></li>
                    <li><a href="<?php echo base_url(); ?>dist/utilities_subscribe">Subscribe</a></li>
                </ul>
            </li>
            <li class="<?php echo $first_uri_segment == 'credits' ? 'active' : ''; ?>"><a class="nav-link"
                                                                                          href="<?php echo base_url(); ?>dist/credits"><i
                            class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
