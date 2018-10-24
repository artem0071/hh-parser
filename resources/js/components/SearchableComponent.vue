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
                        <input class="form-control" id="inputQ" placeholder="Введите запрос">
                    </div>

                </div>
            </form>
        </div>
        <div class="card-body">

            <div class="alert alert-primary" role="alert">
                Начните вводить название
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "searchable-component"
    }
</script>

<style scoped>

</style>