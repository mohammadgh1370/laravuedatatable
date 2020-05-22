<template>
    <div>
        <!-- Top Filters -->
        <slot
                :url="url"
                name="filters"
                v-if="filtersSlot"
                :per-page="perPage"
                :table-data="tableProps">
        </slot>
        <laravel-vue-data-table-filters
                v-else
                :per-page="perPage"
                :table-data="tableProps"
                :placeholder-search="translate.placeholderSearch">
        </laravel-vue-data-table-filters>
        <!-- Table component -->
        <laravel-vue-table
                @sort="sortBy"
                :sortKey="sortKey"
                :columns="columns"
                :dir="tableProps.dir"
                :table-classes="tableClasses.table"
                :table-head-classes="tableClasses['th']"
                :table-head-icon-classes="tableClasses['th-icon']"
                :table-header-classes="tableClasses['t-head']"
                :table-row-classes="tableClasses['t-head-tr']"
                :table-container-classes="tableClasses['table-container']">
            <!-- Table Header -->
            <template
                    slot="header"
                    v-if="headerSlot">
                <slot
                        name="header"
                        :table-props="tableProps">
                </slot>
            </template>
            <!-- Table Body -->
            <template
                    slot="body"
                    v-if="bodySlot">
                <slot
                        name="body"
                        :data="tableData.data">
                </slot>
            </template>
            <template slot="body" v-else>
                <tbody
                        v-if="columns"
                        :class="tableClasses['t-body']"
                        class="laravel-vue-datatable-tbody">
                <tr
                        :key="item.id"
                        :class="tableClasses['t-body-tr']"
                        v-for="(item, index) in tableData.data"
                        @click="$emit('rowClicked', item)"
                        class="laravel-vue-datatable-tbody-tr">
                    <td
                            :key="column.name"
                            :class="tableClasses.td"
                            v-for="column in columns"
                            class="laravel-vue-datatable-td">
                        <laravel-vue-data-table-cell
                                :index="index"
                                :value="item"
                                :name="column.name"
                                :meta="column.meta"
                                :comps="column.components"
                                :cellCheck="cellCheck"
                                @changed="changed"
                                @selectedModal="selectedModal">
                        </laravel-vue-data-table-cell>
                    </td>
                </tr>
                </tbody>
            </template>
        </laravel-vue-table>
        <!-- Bottom Filters -->
        <slot
                :page="page"
                name="pagination"
                v-if="paginationSlot"
                :meta="tableData.meta"
                :links="tableData.links">
        </slot>
        <laravel-pagination
                v-else
                :data="tableData"
                :size="pagination.size"
                :limit="pagination.limit"
                :align="pagination.align"
                @pagination-change-page="paginationChangePage">
            <span slot="prev-nav" v-html="translate.previousButton"></span>
            <span slot="next-nav" v-html="translate.nextButton"></span>
        </laravel-pagination>

        <component :is="selectedRow.modalComponent"
                   v-if="showModal"
                   @hideModal="showModal = false"
                   @changed="changed"
                   :row="selectedRow.data" :classes="modalClasses"></component>
    </div>
</template>

<script>
    import _ from 'lodash';
    import axios from 'axios';
    import VueTable from './Table.vue';
    import UrlFilters from '../mixins/UrlFilters';
    import DataTableCell from './DataTableCell.vue';
    import DataTableFilters from './DataTableFilters.vue';
    import laravelPagination from 'laravel-vue-pagination';

    export default {
        created() {
            if (this.addFiltersToUrl) {
                this.checkParameters(this.tableProps);
            } else if (this.url) {
                this.getData(this.url, this.getRequestPayload);
            }

            if (this.theme == "dark") {
                this.tableClasses['table']['table-dark'] = true;
            }

            this.debounceGetData = _.debounce(this.getData, this.debounceDelay ? this.debounceDelay : 0);
        },
        updated() {
            this.columns.forEach((column) => {
                this.sortOrders[column.name] = this.sortOrders[column.name] ? this.sortOrders[column.name] : false;
            });
        },
        mixins: [UrlFilters],
        watch: {
            url: {
                handler: function (newUrl) {
                    this.updateCurrentPage(newUrl);
                    this.debounceGetData(newUrl);
                },
            },
            tableProps: {
                handler: function () {
                    //Reset current page if searching
                    if (this.tableProps.search) {
                        this.page = 1;
                    }

                    //Check if we are using the default request otherwise emit
                    if (this.url) {
                        this.debounceGetData();
                    } else {
                        let props = this.tableProps;
                        props.page = this.page;
                        this.$emit("onTablePropsChanged", props);
                    }
                },
                deep: true,
            },
            data: {
                handler: function (data) {
                    this.tableData = data;
                }
            },
        },
        data() {
            return {
                debounceGetData: null,
                tableData: {},
                sortKey: 'id',
                sortOrders: {},
                draw: 0,
                page: 1,
                tableProps: {
                    search: '',
                    dir: this.orderDir,
                    column: this.orderBy,
                    filters: this.filters,
                    length: this.perPage[0],
                },
                selectedRow: null,
                showModal: false,
            };
        },
        methods: {
            getData(url = this.url, options = this.getRequestPayload) {

                this.$emit("loading");

                //Remove any custom query string parameters
                let baseUrl = url.split("?")[0];

                axios.get(baseUrl, options)
                    .then(response => {
                        if (response) {
                            const data = response.data;
                            console.log(data)

                            if (this.checkTableDraw(data.payload.draw)) {

                                this.tableData = data;
                                this.$emit("finishedLoading");

                                if (this.addFiltersToUrl) {
                                    this.updateParameters(this.tableProps);
                                }
                            }
                        }
                    })
                    .catch(errors => {
                        alert(errors);
                    });
            },
            addRecord(data) {
                this.tableData.data.push(data);
            },
            sortBy(key, columnName = null) {
                this.sortKey = key;
                this.sortOrders[key] = !this.sortOrders[key];
                this.tableProps.column = columnName ? columnName : key;
                this.tableProps.dir = this.sortOrders[key] === true ? 'desc' : 'asc';
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value);
            },
            incrementDraw() {
                this.draw++;
            },
            checkTableDraw(draw) {
                if (this.draw == draw) {
                    return true;
                }
                return false;
            },
            updateCurrentPage(url) {
                const params = (new URL(url)).searchParams;
                const page = params.get('page');

                if (page) {
                    this.page = page;
                }
            },
            paginationChangePage(page) {
                this.page = page;
                if (Object.keys(this.data).length) {
                    //Add the users pagination
                    let props = this.tableProps;
                    props.page = this.page;
                    this.$emit("onTablePropsChanged", props);
                } else {
                    this.getData();
                }
            },
            changed() {
                this.getData();
            },
            selectedModal(data) {
                this.selectedRow = data;
                this.showModal = true;
            },
        },
        components: {
            'laravel-vue-table': VueTable,
            'laravel-vue-data-table-cell': DataTableCell,
            'laravel-vue-data-table-filters': DataTableFilters,
            'laravel-pagination': laravelPagination,
        },
        computed: {
            paginationSlot() {
                if (this.$scopedSlots) {
                    return this.$scopedSlots.pagination;
                }
                return null;
            },
            filtersSlot() {
                if (this.$scopedSlots) {
                    return this.$scopedSlots.filters;
                }
                return null;
            },
            bodySlot() {
                if (this.$scopedSlots) {
                    return this.$scopedSlots.body;
                }
                return null;
            },
            headerSlot() {
                if (this.$scopedSlots) {
                    return this.$scopedSlots.header;
                }
                return null;
            },
            getRequestPayload() {
                let payload = Object.assign({}, this.tableProps);
                delete payload.filters;
                payload = Object.assign(payload, this.tableProps.filters);
                payload = Object.assign(payload, this.tableProps.filters);
                payload.draw = this.draw;
                payload.page = this.page;
                return {
                    params: payload,
                };
            },
        },
        props: {
            columns: {
                type: Array,
                default: () => ([]),
                required: true,
            },
            url: {
                type: String,
                default: "",
            },
            orderBy: {
                type: String,
                default: 'id',
            },
            data: {
                type: Object,
                default: () => ({}),
            },
            filters: {
                type: Object,
                default: () => ({}),
            },
            addFiltersToUrl: {
                type: Boolean,
                default: false,
            },
            debounceDelay: {
                type: Number,
                default: 0,
            },
            pagination: {
                type: Object,
                default: () => ({
                    limit: 2,
                    align: 'center',
                    size: 'small'
                }),
            },
            perPage: {
                type: Array,
                default: () => ([
                    '10',
                    '25',
                    '50'
                ]),
            },
            orderDir: {
                type: String,
                default: "asc",
                validator: function (value) {
                    return [
                        'asc',
                        'desc'
                    ].indexOf(value) !== -1;
                }
            },
            theme: {
                type: String,
                default: "light",
                validator: function (value) {
                    return [
                        'light',
                        'dark'
                    ].indexOf(value) !== -1;
                }
            },
            tableClasses: {
                type: Object,
                default: () => ({
                    "table-container": {
                        "table-responsive": true,
                    },
                    "table": {
                        "table": true,
                        "table-striped": true,
                        "border": true,
                    },
                    "t-head": {},
                    "t-body": {},
                    "td": {},
                    "th": {},
                    "th-icon": {
                        "asc": {"fa fa-sort-amount-down-alt": true},
                        "desc": {"fa fa-sort-amount-down": true}
                    },
                }),
            },
            modalClasses: {
                type: Object,
                default: () => ({}),
            },
            translate: {
                type: Object,
                default: () => ({
                    nextButton: 'Next',
                    previousButton: 'Previous',
                    placeholderSearch: 'Search Table',
                })
            },
            cellCheck: {
                type: Array,
                default: () => {
                    []
                }
            },
        },
        mounted() {
            //     console.log(this.url);
            //     console.log(this.columns);
            //     console.log(this.orderBy);
            //     console.log(this.data);
            //     console.log(this.filters);
            //     console.log(this.addFiltersToUrl);
            //     console.log(this.debounceDelay);
            //     console.log(this.pagination);
            //     console.log(this.perPage);
            //     console.log(this.orderDir);
            //     console.log(this.theme);
            //     console.log(this.tableClasses);
            //     console.log(this.modalClasses);
            //     console.log(this.translate);
            //     console.log(this.cellCheck);
        }
    }
</script>

<style lang="css">
    .laravel-vue-datatable-th.table-header-sorting {
        cursor: pointer !important;
    }

    @import "../assets/styles/main.css";
</style>
