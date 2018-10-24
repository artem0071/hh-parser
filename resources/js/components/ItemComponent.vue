<template>
    <div class="card">
        <img class="card-img-top" :src="item.image || '/images/placeholder.png'" alt="Item image">
        <div class="card-body">
            <h5 class="card-title">
                <text-highlight :queries="[query]">
                    {{ item.title }}
                </text-highlight>
            </h5>
            <p class="card-text">
                <text-highlight :queries="[query]">
                    {{ item.description }}
                </text-highlight>
            </p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Цена: {{ item.price }}</li>
            <li class="list-group-item">
                <a :href="item.url">Ссылка</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "item-component",
        props: {
            full: {
                type: Boolean,
                default: false
            },
            item: {
                type: Object,
                required: true
            },
            query: {
                type: String,
                required: false,
                default: ''
            }
        }
    }
</script>

<style scoped>

</style>