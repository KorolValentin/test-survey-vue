<template>
    <div class="uk-flex uk-flex-column uk-text-center">
        <ul class="uk-display-inline-block">
            <template v-for="question in questions">
                <!--            <li v-for="question in questions" data-id="{{ question.id }}">-->

                <li><span >
                {{ question.id }}. {{ question.title }} . {{ results[question.id] }}
            </span>
                    <ul class="uk-background-muted">
                        <li v-for="rating in 5" class="uk-flex-inline uk-padding-small">
                            <div role="group">
                                <input
                                    @click="sendAnswer(question.id, rating)"
                                    :name ="'question-' + question.id"
                                    :id="question.id + '-' + rating"
                                    :value="rating"
                                    :checked="results[question.id] == rating"
                                    type="radio"
                                    class="uk-radio">
                                <label :for="question.id + '-' + rating" class="p-1">{{ rating }} , {{ results[question.id] === rating}} , {{ results[question.id] }}</label>
                            </div>
                        </li>
                    </ul>
                </li>
            </template>
        </ul>
    </div>


    <router-link @click="currentPage(1)" class="uk-button uk-button-primary" to="/survey">Prev page</router-link>
    <router-link @click="currentPage(2)" class="uk-button uk-button-primary" to="/survey?page=2">Next page</router-link>
</template>

<script>

export default {
    name: "Survey",
    data() {
        return {
            results: [],
            questions: [],
            page: 1,
            lastPage: {
                type: Number,
                value: null,
            }
        }
    },
    mounted() {
        this.loadQuestions();
        this.loadResults();
    },
    methods: {
        currentPage(page) {
            this.$route.query.page = page;
            this.loadQuestions();
            this.loadResults();
        },

        loadQuestions() {
            let paginate = '';

            if (this.$route.query.page > 1) {
                paginate = '?page='+this.$route.query.page;
                this.page = this.$route.query.page;
            } else {
                this.page = 1;
            }

            axios.get('/api/survey' + paginate)
                .then(res => {
                    console.log(res);
                    this.questions = res.data.data;
                })
        },
        loadResults() {
            axios.get('/api/results')
                .then(res => {
                    this.results = res.data;
                })
        },
        sendAnswer(question, answer) {
            axios.post('/api/addResult',
                {
                    question,
                    answer
                })
                .then(response => {
                    this.results = response.data;
                    console.log(this.results);
                });
        }
    }
}
</script>

<style scoped>
button {
    font-weight: bold;
}

a {
    text-decoration: none;
}

ul {
    list-style: none;
}
</style>
