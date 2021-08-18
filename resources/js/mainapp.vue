<template>
    <div>
        <div v-if="$store.state.user">
            <section class="body">
                <header class="header">
                    <div class="logo-container">
                        <a href="#" class="logo">
                            <img src="assets/img/logos/logo-dark.svg" height="35" alt="Logo Admin" />
                        </a>
                        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>
                    <div class="header-right">
                        <ul class="notifications">
                            <li>
                                <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                    <i class="bx bx-bell"></i>
                                    <span class="badge">3</span>
                                </a>
                                <div class="dropdown-menu notification-menu">
                                    <div class="notification-title">
                                        <span class="float-right badge badge-default">3</span>
                                        Alerts
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <li>
                                                <a href="#" class="clearfix">
                                                    <div class="image">
                                                        <i class="fas fa-thumbs-down bg-danger text-light"></i>
                                                    </div>
                                                    <span class="title">Server is Down!</span>
                                                    <span class="message">Just now</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="clearfix">
                                                    <div class="image">
                                                        <i class="bx bx-lock bg-warning text-light"></i>
                                                    </div>
                                                    <span class="title">User Locked</span>
                                                    <span class="message">15 minutes ago</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="clearfix">
                                                    <div class="image">
                                                        <i class="fas fa-signal bg-success text-light"></i>
                                                    </div>
                                                    <span class="title">Connection Restaured</span>
                                                    <span class="message">10/10/2017</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <hr />
                                        <div class="text-right">
                                            <a href="#" class="view-more">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <span class="separator"></span>
                        <div id="userbox" class="userbox">
                            <a href="#" data-toggle="dropdown">
                                <figure class="profile-picture">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
                                </figure>
                                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                    <span class="name">{{ $store.state.userName }}</span>
                                    <span class="role">Administrator</span>
                                </div>
                                <i class="fa custom-caret"></i>
                            </a>
                            <div class="dropdown-menu">
                                <ul class="list-unstyled mb-2">
                                    <li class="divider"></li>
                                    <li>
                                        <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="bx bx-user-circle"></i> My Profile</a>
                                    </li>
                                    <li>
                                        <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="bx bx-lock"></i> Lock Screen</a>
                                    </li>
                                    <li>
                                        <router-link to="/logout" role="menuitem" tabindex="-1"><i class="bx bx-power-off"></i> Logout</router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="inner-wrapper">
                    <aside id="sidebar-left" class="sidebar-left">
                        <div class="sidebar-header">
                            <div class="sidebar-title">
                                Navigation
                            </div>
                            <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                                <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
                            </div>
                        </div>
                        <div class="nano">
                            <div class="nano-content">
                                <nav id="menu" class="nav-main" role="navigation">
                                    <ul class="nav nav-main">
                                        <li>
                                            <router-link to="/home" class="nav-link">
                                                <i class="bx bx-book-alt" aria-hidden="true"></i>
                                                <span>Home</span>
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link to="/role" class="nav-link">
                                                <i class="bx bx-book-alt" aria-hidden="true"></i>
                                                <span>Role</span>
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link to="/user" class="nav-link">
                                                <i class="bx bx-book-alt" aria-hidden="true"></i>
                                                <span>User</span>
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link to="/permission" class="nav-link">
                                                <i class="bx bx-book-alt" aria-hidden="true"></i>
                                                <span>Permission</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </aside>
                    <section role="main" class="content-body">
                        <router-view></router-view>
                    </section>
                </div>
                <aside id="sidebar-right" class="sidebar-right">
                    <div class="nano">
                        <div class="nano-content">
                            <a href="#" class="mobile-close d-md-none">
                                Collapse <i class="fas fa-chevron-right"></i>
                            </a>
                            <div class="sidebar-right-wrapper">

                                <div class="sidebar-widget widget-calendar">
                                    <h6>Upcoming Tasks</h6>
                                    <div data-plugin-datepicker data-plugin-skin="dark"></div>

                                    <ul>
                                        <li>
                                            <time datetime="2017-04-19T00:00+00:00">04/19/2017</time>
                                            <span>Company Meeting</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="sidebar-widget widget-friends">
                                    <h6>Friends</h6>
                                    <ul>
                                        <li class="status-online">
                                            <figure class="profile-picture">
                                                <img src="assets/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                            </figure>
                                            <div class="profile-info">
                                                <span class="name">Joseph Doe Junior</span>
                                                <span class="title">Hey, how are you?</span>
                                            </div>
                                        </li>
                                        <li class="status-online">
                                            <figure class="profile-picture">
                                                <img src="assets/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                            </figure>
                                            <div class="profile-info">
                                                <span class="name">Joseph Doe Junior</span>
                                                <span class="title">Hey, how are you?</span>
                                            </div>
                                        </li>
                                        <li class="status-offline">
                                            <figure class="profile-picture">
                                                <img src="assets/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                            </figure>
                                            <div class="profile-info">
                                                <span class="name">Joseph Doe Junior</span>
                                                <span class="title">Hey, how are you?</span>
                                            </div>
                                        </li>
                                        <li class="status-offline">
                                            <figure class="profile-picture">
                                                <img src="assets/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                            </figure>
                                            <div class="profile-info">
                                                <span class="name">Joseph Doe Junior</span>
                                                <span class="title">Hey, how are you?</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>
            </section>
        </div>
        <div v-else>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "mainapp",
    data(){
        return {

        }
    }
}

// if (typeof localStorage !== 'undefined') {
//     if (localStorage.getItem('sidebar-left-position') !== null) {
//         var initialPosition = localStorage.getItem('sidebar-left-position'),
//             sidebarLeft = document.querySelector('#sidebar-left .nano-content');
//         sidebarLeft.scrollTop = initialPosition;
//     }
// }

</script>

<style scoped>

</style>
