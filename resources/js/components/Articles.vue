<template>
    <div>
        <h2>Articles</h2>
        <form @submit.prevent="addArticle()" class="card mb-5">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" v-model="article.title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" rows="4" v-model="article.body"
                              placeholder="Body"></textarea>
                </div>
                <button type="submit" class="btn btn-light btn-block">Yo</button>
            </div>
        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" :class="[{disabled: !pagination.prev_page_url}]">
                    <a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">Page {{pagination.current_page}} of
                        {{pagination.last_page}}</a>
                </li>
                <li class="page-item" :class="[{disabled: !pagination.next_page_url}]">
                    <a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>

        <div class="card mb-2" v-for="article in articles" :key="article.id">
            <div class="card-body">
                <h3 class="card-title">{{article.id}}. {{article.title}}</h3>
                <p class="card-text">{{article.body}}</p>
                <hr>
                <button class="btn btn-danger float-right" @click="deleteArticle(article.id)">Delete</button>
                <button class="btn btn-warning float-right mr-2" @click="editArticle(article)">Edit me</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                articles: [],
                article: {
                    id: '',
                    title: '',
                    body: ''
                },
                article_id: '',
                pagination: {},
                edit: false
            }
        },
        created() {
            this.fetchArticles();
        },
        methods: {
            fetchArticles(page_url) {
                page_url = page_url || '/api/articles';
                // fetch(page_url)
                //     .then(res => {
                //         return res.json();
                //     })
                //     .then(res => {
                //         this.articles = res.data;
                //         this.makePagination(res.meta, res.links);
                //     })
                //     .catch(err => console.log(err))
                axios.get(page_url)
                    .then(response => {
                        let res = response.data;
                        console.log(response);
                        console.log(res);
                        this.articles = res.data;
                        this.makePagination(res.meta, res.links);
                    })
                    .catch(err => {
                        console.log(err);
                        console.log(err);
                    })
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                };
                this.pagination = pagination
            },
            deleteArticle(id) {
                if (confirm('Are you suree?')) {
                    fetch(`/api/articles/${id}`, {
                        method: 'DELETE'
                    })
                        .then(res => res.json())
                        .then(res => {
                            alert("I'm disappeared");
                            this.fetchArticles();
                        })
                        .catch(err => console.log(err))
                }
            },
            addArticle() {
                if (this.edit == false) {
                    // Add
                    // fetch('/api/articles', {
                    //     method: 'POST',
                    //     body: {
                    //         title: this.article.title,
                    //         body: this.article.body
                    //     },
                    //     headers: {
                    //         'content-type': 'application/json'
                    //     }
                    // })
                    //     .then(res => res.json())
                    //     .then(res => {
                    //         alert("Here we go");
                    //         this.article.title = '';
                    //         this.article.body = '';
                    //         this.fetchArticles();
                    //     })
                    // .catch(err => console.log(err))
                    axios.post('/api/articles', this.article)
                        .then(response => {
                            alert("Here we go");
                            this.article.title = '';
                            this.article.body = '';
                            this.fetchArticles();
                        })
                        .catch(err => {
                            console.log(err)
                        })
                } else if (this.edit == true && this.article.id != null) {
                    // Update
                    fetch('/api/articles/' + this.article.id, {
                        method: 'PUT',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(res => {
                            alert("Here we goooo");
                            this.article.title = '';
                            this.article.body = '';
                            this.fetchArticles();
                        })
                        .catch(err => console.log(err))
                }
            },
            editArticle(article) {
                this.edit = true;
                this.article.id = article.id;
                this.article_id = article.id;
                this.article.title = article.title;
                this.article.body = article.body;
            }
        }
    }
</script>

<style scoped>

</style>
