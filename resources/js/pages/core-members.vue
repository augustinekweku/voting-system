<template>
    <div class="core-members">
        <div class="pt-3">
            <div class="container">
                <div id="left-navbar" class="left-nav">
                    <b-nav vertical class="make-me-sticky">
                        <b-nav-item
                            @click="showCandidates('presidential')"
                            class="my-1 nav_item"
                            active
                            >Presidential</b-nav-item
                        >
                        <b-nav-item
                            @click="showCandidates('vice_president')"
                            class="my-2"
                            >Vice President</b-nav-item
                        >
                        <b-nav-item
                            @click="showCandidates('general_secretary')"
                            class="my-2"
                            >General Secretary</b-nav-item
                        >
                        <b-nav-item class="my-2"
                            >Financial Secretary</b-nav-item
                        >
                        <b-nav-item class="my-2">Public Relations</b-nav-item>
                        <b-nav-item class="my-2">General Organizer</b-nav-item>
                        <b-nav-item class="my-2"
                            >Coordinating Secretary</b-nav-item
                        >
                        <b-nav-item class="my-2"
                            >Secretary for Education</b-nav-item
                        >
                        <b-nav-item class="my-2"
                            >Press and Information</b-nav-item
                        >
                        <b-nav-item class="my-2">Computer Prefect</b-nav-item>
                        <b-nav-item class="my-2"
                            >Utility/Water Prefect</b-nav-item
                        >
                    </b-nav>
                </div>
                <div class="main-page pt-3">
                    <!-- CONTENT -->
                    <candidates :data="candidates_data" />
                    <!-- CONTENT -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { general_secretary, presidential, vice_president } from "../candidates";
export default {
    data() {
        return {
            candidates_data: []
        };
    },
    methods: {
        showCandidates(type) {
            switch (type) {
                case "presidential":
                    this.candidates_data = presidential;
                    console.log("sdfasfasd");
                    break;
                case "vice_president":
                    this.candidates_data = vice_president;
                    break;
                case "general_secretary":
                    this.candidates_data = general_secretary;
                    break;

                default:
                    break;
            }
        }
    },
    created() {
        this.candidates_data = presidential;
        console.log(presidential);
    }
};
</script>

<style></style>
