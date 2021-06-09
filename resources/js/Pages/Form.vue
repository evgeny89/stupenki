<template>
    <div class="wrapper blocks">
        <form action="#" id="setStupenki" class="form-add-post">
            <div class="flex-between">
                <label for="country" class="label">Страна:</label>
            </div>
            <vue-multiselect id="country"
                             name="select-country"
                             placeholder=""
                             track-by="name"
                             select-label=""
                             label="name"
                             v-model="country"
                             :options="searchResultCountry"
                             :loading="isLoading"
                             :clear-on-select="false"
                             :hide-selected="false"
                             :preserve-search="true"
                             :options-limit="30"
                             :show-no-results="true"
                             :taggable="true"
                             @search-change="asyncFindCountry"
                             @tag="addCountry"
                             class="input-multiselect"
            >
            </vue-multiselect>
            <input type="hidden" name="country" :value="countryName">
            <div class="flex-between">
                <label for="city" class="label">Город:</label>
            </div>
            <vue-multiselect id="city"
                             name="select-city"
                             placeholder=""
                             track-by="name"
                             select-label=""
                             label="name"
                             v-model="city"
                             :options="searchResultCity"
                             :loading="isLoading"
                             :clear-on-select="false"
                             :hide-selected="false"
                             :preserve-search="true"
                             :options-limit="30"
                             :show-no-results="true"
                             :taggable="true"
                             @search-change="asyncFindCity"
                             @tag="addCity"
                             class="input-multiselect"
            >
            </vue-multiselect>
            <input type="hidden" name="city" :value="cityName">
            <div class="flex-between">
                <label for="name" class="label">Наименование:</label>
            </div>
            <input type="text" id="name" name="name" class="input" v-model="name">
            <div class="flex-between">
                <label for="image" class="label">Фотография:</label>
            </div>
            <div class="image-label" :class="{'image-label_set': image}" @click="openFileDialog">
                <span>{{ getImage }}</span>
                <button class="btn-delete" type="button" @click.stop="clearImage" v-if="image">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
            <input type="file" ref="image-input" id="image" name="image" class="file-input" @change="setImage">
            <div class="flex-between">
                <label for="count" class="label">Количество ступенек:</label>
            </div>
            <input type="number" id="count" name="count" class="input" v-model="count">
            <button class="btn" :disabled="!disableBtn" type="button" @click="send">Добавить</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import Multiselect from "vue-multiselect";

export default {
    name: "Form",
    components: {'vue-multiselect': Multiselect},
    data() {
        return {
            country: null,
            city: null,
            name: null,
            image: null,
            count: null,
            isLoading: false,
            searchResultCountry: [],
            searchResultCity: [],
        }
    },
    computed: {
        disableBtn: function () {
            return this.name && +this.count > 0 && this.countryName.length && this.cityName.length && this.image.length;
        },
        countryName: function () {
            return this.country ? this.country.name : '';
        },
        cityName: function () {
            return this.city ? this.city.name : '';
        },
        getImage: function () {
            return this.image ? this.image : 'Выбрать фото';
        },
    },
    methods: {
        send: function () {
            axios({
                method: 'POST',
                url: 'api/stupenka',
                headers: {
                    'Content-Type': 'multipart/form-data;boundary="boundary"',
                },
                data: new FormData(setStupenki),
            })
                .then(response => response.data)
                .then(data => {
                    if (data.status === 'Success') {
                        this.$notify(data.message);
                        this.$router.push({name: 'home'});
                    }
                })
                .catch(e => {
                    if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
                });
        },
        openFileDialog: function () {
            this.$refs["image-input"].click();
        },
        setImage: function () {
            this.image = this.$refs["image-input"].files[0]?.name ?? null;
        },
        clearImage: function () {
            this.$refs["image-input"].value = '';
            this.image = null;
        },
        asyncFindCountry: function (search) {
            if (search.length < 3) {
                return;
            }
            this.isLoading = true
            axios({
                method: 'GET',
                url: 'api/search_country',
                params: {search},
            })
                .then(response => {
                    this.searchResultCountry = response.data.data
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
        asyncFindCity: function (search) {
            if (search.length < 3) {
                return;
            }
            this.isLoading = true
            axios({
                method: 'GET',
                url: 'api/search_city',
                params: {search},
            })
                .then(response => {
                    this.searchResultCity = response.data.data
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
        addCountry: function (country) {
            this.country = {
                name: country,
                type: 'country',
            };
        },
        addCity: function (city) {
            this.city = {
                name: city,
                type: 'city',
            };
        },
    }
}
</script>

