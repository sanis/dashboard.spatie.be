<template>
    <tile :position="position" modifiers="overflow">
       <section class="sentry">
           <h1 class="sentry__title">Sentry Errors ({{ errors.length }})</h1>
           <ul class="sentry_error">
               <li v-for="error in errors" class="sentry_error">
                   <p class="sentry__error_last_context">{{ error.last_context }}</p>
                   <p class="sentry__error_class">{{ error.class }}</p>
                   <p class="sentry__error_misc">{{ error.occurrences }} events | {{ error.last_received }}</p>
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
                'Sentry.ErrorsFetched': response => {
                    this.errors = response.errors;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'sentry-errors',
            };
        },
    },
};
</script>
