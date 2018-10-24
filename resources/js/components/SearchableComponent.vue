<template>
    <div class="card">
        <div class="card-header">
            <div class="pb-3">
                <a href="/imports">Загрузить</a>
            </div>
            <form>
                <div class="form-group">
                    <div class="m-auto">
                        <label for="inputQ">Введите запрос</label>
                        <input v-model="q" @input="getItems(1)" class="form-control" id="inputQ" placeholder="Введите запрос">
                    </div>

                </div>
            </form>
        </div>
        <div class="card-body">

            <div v-if="items.length">
                <div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item" :class="pagination.current === 1 ? 'disabled' : ''">
                                <a @click.prevent="getItems(pagination.current - 1)" class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item" :class="pagination.current === pagination.last ? 'disabled' : ''">
                                <a @click.prevent="getItems(pagination.current + 1)" class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <div v-for="(item, index) in items" :key="index" class="col-md-3">
                        <item-component :item="item" :query="q" />
                    </div>
                </div>
            </div>

            <div v-else>
                <div class="alert alert-primary" role="alert">
                    Начните вводить название
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import _ from 'lodash'
    import itemComponent from './ItemComponent'
    export default {
        name: "searchable-component",
        components: {
            itemComponent
        },
        data: () => ({
            q: '',
            items: [],
            pagination: {
                current: 1,
                last: 1
            }
        }),
        methods: {
            getItems: _.debounce(function (page) {
                axios.get('/api/items/search', {
                    params: {
                        q: this.q,
                        page: page || 1
                    }
                })
                    .then(response => {
                        this.items = response.data.data
                        this.pagination.current = response.data.meta.current_page
                        this.pagination.last = response.data.meta.last_page
                    })
            }, 400)
        }

    }
</script>

<style scoped>

</style>