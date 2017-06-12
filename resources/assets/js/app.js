import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import Github from './components/Github';
import InternetConnection from './components/InternetConnection';
import Packagist from './components/Packagist';
import Tasks from './components/Tasks';
import TimeWeather from './components/TimeWeather';
import Twitter from './components/Twitter';
import LaravelNews from './components/LaravelNews';
import BugsnagErrors from './components/BugsnagErrors';

new Vue({

    el: '#dashboard',

    components: {
        Github,
        InternetConnection,
        Packagist,
        Tasks,
        TimeWeather,
        Twitter,
        LaravelNews,
        BugsnagErrors,
    },

    created() {

        let options = {
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
            cluster: window.dashboard.pusherCluster,
        };

        if (window.dashboard.usingNodeServer) {
            options = {
                broadcaster: 'socket.io',
                host: 'http://dashboard.spatie.be:6001',
            };
        }

        this.echo = new Echo(options);
    },
});
