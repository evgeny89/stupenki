<template>
    <div class="wrapper blocks">
        <div class="search-select">
            <label class="typo__label" for="ajax">Выберите город или страну:</label>
            <vue-multiselect id="ajax"
                             placeholder="начните вводить для поиска"
                             track-by="id"
                             select-label=""
                             label="name"
                             v-model="selected"
                             :options="searchResult"
                             :loading="isLoading"
                             :clear-on-select="true"
                             :hide-selected="false"
                             :preserve-search="false"
                             :options-limit="30"
                             :show-no-results="true"
                             @search-change="asyncFind"
                             @select="getStupenki"
                             @remove="clearStupenki"
                             group-values="values"
                             group-label="type"
            >
                <span slot="noResult">Записи не найдены</span>
                <span slot="noOptions">Список пуст</span>
            </vue-multiselect>
        </div>
        <div class="user-post-list">
            <div v-for="item in stupenki" :key="item.id" class="user-post">
                <h3 class="post-title">{{ item.name }}</h3>
                <p>страна: {{ item.country.name }}, город: {{ item.city.name }}</p>
                <p>количество ступенек: {{ item.count }}</p>
                <p>добавлено: {{ item['created_at'] }}г.</p>
                <div class="image-block">
                    <img :src="item['image_small']"
                         :alt="item.name"
                         class="image-small-size"
                    >
                    <img :src="item['image_origin']"
                         :alt="item.name + 'origin'"
                         class="image-full-size"
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Multiselect from "vue-multiselect";

export default {
    name: "Search",
    components: {'vue-multiselect': Multiselect},
    data() {
        return {
            searchResult: [],
            selected: null,
            isLoading: false,
            stupenki: [],
        }
    },
    methods: {
        asyncFind: function (search) {
            this.selected = null;
            if (search.length < 3) {
                return;
            }
            this.isLoading = true
            axios({
                method: 'GET',
                url: 'api/search',
                params: {search},
            })
                .then(response => {
                    this.searchResult = response.data.data
                    this.isLoading = false
                })
                .catch(e => {
                    if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
                });
        },
        getStupenki: function (option) {
            axios({
                method: 'GET',
                url: 'api/get_by_search',
                params: {
                    type: option.type,
                    value: option.id,
                },
            })
                .then(response => {
                    this.stupenki = response.data.data
                })
                .catch(e => {
                    if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
                });
        },
        clearStupenki: function () {
            this.stupenki = [];
        },
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
