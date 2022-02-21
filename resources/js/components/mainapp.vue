<template>
    <div>
        <div class="mainapp">
            <div v-if="$store.state.user" class="logged-in-view">
                <!-- START OF NAVBAR -->
                <div>
                    <b-navbar
                        style="box-shadow: 0px 1px 5px #999;"
                        fixed="top"
                        toggleable="lg"
                        type="light"
                        class="bg-white mb-4"
                        variant=""
                    >
                        <b-navbar-brand href="#">
                            <span style="margin-right:-6px"
                                ><b-icon icon="caret-right-fill"></b-icon
                            ></span>
                            Xtra<span style="font-weight:bold;"
                                >Class</span
                            ></b-navbar-brand
                        >

                        <b-navbar-toggle
                            target="nav-collapse"
                        ></b-navbar-toggle>

                        <b-collapse id="nav-collapse" is-nav>
                            <!-- Right aligned nav items -->
                            <b-navbar-nav class="ml-auto">
                                <b-nav-form>
                                    <b-icon icon="search"></b-icon>
                                </b-nav-form>
                                <b-nav-item v-if="!$store.state.user">
                                    <b-button
                                        size="sm"
                                        class="my-2 my-sm-0"
                                        type="submit"
                                        rounded
                                        ><b-icon icon="person-fill"></b-icon>
                                        Login</b-button
                                    >
                                </b-nav-item>
                                <b-nav-item v-if="$store.state.user">
                                    <b-button
                                        size="sm"
                                        class="my-2 my-sm-0"
                                        rounded
                                        @click="logout"
                                        ><b-icon icon="power"></b-icon>
                                        Logout</b-button
                                    >
                                </b-nav-item>
                            </b-navbar-nav>
                        </b-collapse>
                    </b-navbar>
                </div>
                <!-- END OF NAVBAR -->

                <!-- START OF INTRO JUMBOTRON -->
                <div class="intro mt-4">
                    <div class="intro__inner container pt-5 pb-5">
                        <h1 class="font-weight-light mt-4">CCHN - Winneba</h1>
                        <p class="font-weight-light">
                            College of Community Health Nursing
                        </p>
                        <p class="font-weight-lighter">
                            2020/2021 Academic Year Elections
                        </p>
                    </div>

                    <!-- START OF TABS -->
                    <div class="top-menu-tabs container">
                        <div>
                            <b-nav tabs>
                                <b-nav-item to="/core-members"
                                    >Core Members</b-nav-item
                                >
                                <b-nav-item to="/auxiliary-members"
                                    >Auxiliary Members</b-nav-item
                                >
                                <b-nav-item to="/results">Results</b-nav-item>
                                <b-nav-item-dropdown
                                    v-if="($store.state.user.role_id = 1)"
                                    id="my-nav-dropdown"
                                    text="Admin"
                                    toggle-class="nav-link-custom"
                                    right
                                >
                                    <div
                                        class="animate__animated animate__slideInDown"
                                    >
                                        <b-dropdown-item to="/admin-candidates"
                                            >Candidates</b-dropdown-item
                                        >
                                        <b-dropdown-item
                                            to="/aspiring-positions"
                                            >Aspiring Positions</b-dropdown-item
                                        >
                                        <b-dropdown-item to="/admin-winners"
                                            >Winners</b-dropdown-item
                                        >
                                        <b-dropdown-item to="/admin-voters"
                                            >Voters</b-dropdown-item
                                        >
                                        <b-dropdown-item to="/admin-roles"
                                            >Roles</b-dropdown-item
                                        >
                                    </div>
                                </b-nav-item-dropdown>
                            </b-nav>
                        </div>
                    </div>
                    <!-- END OF TABS -->
                </div>
                <!-- END OF INTRO JUMBOTRON -->
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user"],
    components: {},
    data() {
        return {};
    },
    methods: {
        async logout() {
            const res = await this.callApi("get", "/logout");
            if ((res.status = 200)) {
                window.location = "/";
            }
        }
    },
    created() {
        this.$store.commit("setUpdateUser", this.user);
        console.log(this.user);
    }
};
</script>

<style>
#app {
    margin: 0 0;
}
.intro {
    background: rgb(14, 97, 111);
    background: linear-gradient(
        90deg,
        rgba(14, 97, 111, 1) 0%,
        rgba(64, 191, 159, 1) 100%,
        rgba(19, 162, 147, 1) 100%
    );
    color: white;
}
.nav-tabs .nav-link {
    border: none;
}

.top-menu-tabs a {
    color: white;
    background: rgb(20, 74, 83);
}

.left-nav a,
.left-nav__fixed a {
    background: rgb(202, 230, 235);
    color: rgb(56, 56, 56);
}
.router-link-exact-active {
    background: white !important;
    color: rgb(39, 107, 119) !important;
}
.left-nav a:focus {
    background: rgb(26, 46, 49) !important;
    color: white !important;
}
.left-nav {
    position: absolute;
    height: 100%;
    z-index: 1;
    overflow-x: hidden;
    overflow-y: auto;
    width: 20%;
    padding-top: 20px;
}
.left-nav__fixed {
    position: fixed;
    top: 0;
    height: 100%;
    z-index: 1;
    overflow-x: hidden;
    overflow-y: auto;
    width: 20%;
    padding-top: 20px;
}
.main-page {
    margin-left: 30% !important;
    position: relative;
}
.intro__inner {
    margin-top: 40px;
    padding-top: 20px;
}

.left-nav a {
    border-radius: 5px;
}
</style>
