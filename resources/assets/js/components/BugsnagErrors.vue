<template>
    <tile :position="position" modifiers="overflow">
       <section class="bugsnag">
           <h1 class="bugsnag__title">Bugsnag Errors ({{ errors.length }})</h1>
           <ul class="bugsnag_error">
               <li v-for="error in errors" class="bugsnag_error">
                   <p class="bugsnag__error_last_context">{{ error.last_context }}</p>
                   <p class="bugsnag__error_class">{{ error.class }}</p>
                   <p class="bugsnag__error_misc">{{ error.occurrences }} events | {{ error.last_received }}</p>
               </li>
           </ul>
       </section>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';

export default {

    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position'],

    data() {
        return {
            errors: [],
        };
    },

    methods: {

        getEventHandlers() {
            return {
                'Bugsnag.ErrorsFetched': response => {
                    this.errors = response.errors;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'bugsnag-errors',
            };
        },
    },
};
</script>
