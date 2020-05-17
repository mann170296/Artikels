<template>
    <div class="container my-5">
        <h1>Artikels</h1>
        <p>Artikels is built using Laravel and Vue.js. Get this on <a href="">GitHub</a></p>
        <br>
        <button class="btn btn-sm btn-success" @click="openAddModal">
            Add an Artikle
        </button>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <p class="text-danger text-center" v-if="dataCount == 0">
                    No articles found. Go ahead and add some
                </p>
            </div>
            <div class="col-md-4 cardContainer" v-for="article in articles.data" :key="article.id">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ article.title }}</h3>
                        <p>{{ article.content }}</p>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary" @click="updateArtikle(article.id)">
                            Update Artikle
                        </button>
                        <button class="btn btn-sm btn-danger" @click="deleteArtikle(article.id)">
                            Delete Artikle
                        </button>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <pagination :data="articles" @pagination-change-page="getResults">
            <span slot="prev-nav">&lt; Previous</span>
            <span slot="next-nav">Next &gt;</span>
        </pagination>

        <!-- Modal -->
        <div class="modal fade" id="addArtikle" tabindex="-1" role="dialog" aria-labelledby="addArtikle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addArtikleModalLabel" v-if="!isUpdating">Add a new Artikle</h5>
                        <h5 class="modal-title" id="addArtikleModalLabel" v-else>Update Artikle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Artikle Title</label>
                            <input type="text" id="title" class="form-control" v-model="newArticle.title">
                        </div>
                        <div class="form-group">
                            <label for="content">Artikle Content</label>
                            <textarea id="content" class="form-control" rows="5" v-model="newArticle.content"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="addArtikle" v-if="!isUpdating">
                            Add
                        </button>
                        <button type="button" class="btn btn-success" @click="updateTheArtikle(newArticle.id)" v-else>
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Articles',
    data() {
        return {
            isUpdating: false,
            dataCount: 0,
            articles: {},
            newArticle: {
                id: '',
                title: '',
                content: '',
            }
        }
    },
    methods: {

        openAddModal() {
            if(this.isUpdating === true) {
                this.isUpdating = false;
            } 

            this.newArticle.title = '';
            this.newArticle.content = '';

            $('#addArtikle').modal('show');
        },

        getResults(page = 1) {
            axios.get('api/articles?page=' +page)
                .then(response => {
                    this.articles = response.data;
                    this.dataCount = this.articles.data.length;
                })
                .catch(error => console.log(error))
        },

        deleteArtikle(id) {
            axios.delete('api/articles/' + id)
                .then(res => {
                    this.getResults();
                    console.log("Artikle deleted");
                })
                .catch(Error => console.log(error))
        },

        addArtikle() {
            axios.post('api/articles', {
                title: this.newArticle.title,
                content: this.newArticle.content
            })
                .then(res => {
                    this.getResults();
                    $('#addArtikle').modal('hide');
                    console.log("Content was added");
                })
                .catch(error => console.log("error"))
        },

        updateArtikle(id) {
            if(this.isUpdating === false) {
                this.isUpdating = true;
            }
            axios.get('api/articles/' +id)
                .then(res => {
                    this.newArticle.id = res.data.data.id;
                    this.newArticle.title = res.data.data.title;
                    this.newArticle.content = res.data.data.content;
                    $('#addArtikle').modal('show');
                })
                .catch(error => console.log(error))
        },

        updateTheArtikle(id) {
            axios.put('api/articles/' +id, {
                title: this.newArticle.title,
                content: this.newArticle.content,
            })
                .then(res => {
                    this.getResults();
                    $('#addArtikle').modal('hide');
                })
                .catch(error => console.log(error))
        },
    },

    created() {
        this.getResults();
    },
}
</script>

<style scoped>
    .cardContainer {
        margin-bottom: 20px;
    }
    .card {
        height: 100%;
    }
</style>