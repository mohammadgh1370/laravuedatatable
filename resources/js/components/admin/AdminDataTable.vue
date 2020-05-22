<template>
    <div>
        <data-table :url="props.url"
                    :columns="props.columns"
                    :tableClasses="props.tableClasses"
                    :orderBy="props.orderBy"
                    :orderDir="props.orderDir"
                    :perPage="props.perPage"
                    :pagination="props.pagination"
                    :translate="props.translate"
                    :theme="props.theme"
                    :cellCheck="props.cellCheck"
                    :debounceDelay="props.debounceDelay"
                    :addFiltersToUrl="props.addFiltersToUrl"
                    :filters="props.filters"
                    :modalClasses="props.modalClasses"
        ></data-table>

        <!--        <example-modal v-if="showModal"-->
        <!--                       @hideModal="showModal = false"-->
        <!--                       :row="selectedRow" :classes="modalClasses"></example-modal>-->
<!--        <component :is="selectedRow.modalComponent"-->
<!--                   v-if="showModal"-->
<!--                   @hideModal="showModal = false"-->
<!--                   :row="selectedRow.data" :classes="props.modalClasses"></component>-->
    </div>
</template>

<script>
    import DataTable from '../datatable/src/components/DataTable';
    import DataTableButton from './DataTableButton';

    export default {
        name: "AdminDataTable",
        props: {
            // url:{type: String},
            // translate: {type: Object}
            props: {type: Object}
        },
        components: {DataTable},
        data() {
            return {
                //         modalClasses:{
                //             'modal-lg': true,
                //             'modal-dialog-centered': true
                //         },
                //         columns: [
                //             {
                //                 label: 'id',
                //                 name: 'id',
                //                 orderable: true,
                //             },
                //             {
                //                 label: 'full_name',
                //                 name: 'full_name',
                //                 orderable: true,
                //             },
                //             {
                //                 label: 'email',
                //                 name: 'email',
                //                 orderable: true,
                //             },
                //             {
                //                 label: 'mobile',
                //                 name: 'mobile',
                //                 orderable: true,
                //             },
                //             {
                //                 label: 'weight',
                //                 name: 'bio.weight',
                //                 orderable: true,
                //             },
                //             {
                //                 label: 'height',
                //                 name: 'bio.height',
                //                 orderable: true,
                //             },
                //             {
                //                 label: 'created_at',
                //                 name: 'bio.shamsi_created_at',
                //                 orderable: true,
                //             },
                //             {
                //                 label: 'action',
                //                 orderable: false,
                //                 components: [
                //                     {
                //                         name: 'show',
                //                         classes: {
                //                             button: {
                //                                 'btn': true,
                //                                 'btn-warning': true,
                //                                 'btn-sm': true,
                //                                 'btn-block': true
                //                             },
                //                             icon: {
                //                                 'fa': true,
                //                                 'fa-eye': true
                //                             }
                //                         },
                //                         event: "click",
                //                         handler: this.SelectedModal,
                //                         buttonComponent: DataTableButton,
                //                         modalComponent: 'example-modal1',
                //                         access: true
                //                     },
                //                     {
                //                         name: 'edit',
                //                         classes: {
                //                             button: {
                //                                 'btn': true,
                //                                 'btn-success': true,
                //                                 'btn-sm': true,
                //                                 'btn-block': true
                //                             },
                //                             icon: {
                //                                 'fa': true,
                //                                 'fa-pencil': true
                //                             }
                //                         },
                //                         event: "click",
                //                         handler: this.SelectedModal,
                //                         buttonComponent: DataTableButton,
                //                         modalComponent: 'example-modal',
                //                         access: false
                //                     },
                //                     {
                //                         name: 'delete',
                //                         classes: {
                //                             button: {
                //                                 'btn': true,
                //                                 'btn-danger': true,
                //                                 'btn-sm': true,
                //                                 'btn-block': true
                //                             },
                //                             icon: {
                //                                 'far': true,
                //                                 'fa-trash': true
                //                             }
                //                         },
                //                         method: 'delete',
                //                         href: this.url,
                //                         buttonComponent: DataTableButton,
                //                         access: false
                //                     }
                //                 ]
                //             },
                //         ],
                //         comp: null,
                selectedRow: null,
                showModal: false
            }
        },
        // created(){
        //   console.log(this.props.modalClasses)
        // },
        methods: {
            // selectedModal(data) {
            //     console.log(data)
            //     console.log('props')
            //     console.log(this.props)
            //     this.selectedRow = data;
            //     this.showModal = true;
            // },
        },
    }
</script>

<style scoped>

</style>