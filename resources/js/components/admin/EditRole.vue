<template>
    <div>
        <div class="modal modal-active fade show" id="exampleModal" tabindex="-1"
             role="dialog" @click.self="$emit('hideModal')">
            <div class="modal-dialog" :class="classes" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ویرایش نقش</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                @click="$emit('hideModal')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">نام نقش</label>
                                    <input type="text" id="name" class="form-control" v-model="item.name"
                                           placeholder="نام نقش را وارد کنید، برای مثال: writer"
                                           :class="{'is-invalid': errors.name}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="label">برچسب مجوز</label>
                                    <input type="text" id="label" class="form-control" v-model="item.label"
                                           placeholder="برچسب نقش را وارد کنید، برای مثال: نویسنده"
                                           :class="{'is-invalid': errors.label}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guard_name">نوع کاربر</label>
                                    <select class="form-control" name="guard_name" id="guard_name"
                                            :class="{'is-invalid': errors.guard_name}" v-model="item.guard_name">
                                        <option v-for="guard in guards">{{guard}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guard_name">مجوزها</label>
                                    <select-search :options="permissions"
                                                   name="permission_id"
                                                   :chosen="item.permissions"
                                                   key-option="label"
                                                   key-data="id"
                                                   :classes="errors.permission_id ? 'is-invalid' : ''"
                                                   placeholder="مجوز را انتخاب کنید"
                                                   :multiple="true"
                                                   @selected="selected"></select-search>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="submit">تایید</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-backdrop fade show"></div>
    </div>
</template>
<script>
    import SelectSearch from "../SelectSearch";
    export default {
        name: 'EditRole',
        props: {
            row: {
                type: Object,
                default: () => ({}),
            },
            classes: {
                type: Object,
                default: () => ({}),
            },
        },
        components:{SelectSearch},
        data() {
            return {
                item: {},
                guards: [],
                permissions: [],
                errors: []
            }
        },
        created() {
            this.item = Object.assign({}, this.row);
            this.getPermissions();
        },
        methods: {
            submit() {
                window.axios.put('/admin/role/' + this.row.id, this.item)
                    .then(response => {
                        if (response.data.code == 1) {
                            this.$emit('changed');
                            this.$emit('hideModal');
                            window.eventBus.$emit('flash', response.data);
                        } else {
                            this.errors = response.data.data;
                            window.eventBus.$emit('flash', response.data);
                        }
                    });
            },
            getPermissions() {
                window.axios.get('/admin/permission', {
                    params: {get: 1, dir: 'asc'}
                }).then(response => {
                    this.permissions = response.data.data;
                    response.data.data.map(item => {
                        if (!this.guards.find(guard => guard == item.guard_name))
                            this.guards.push(item.guard_name);
                    });
                });
            },
            selected(data) {
                this.item['permission_id'] = [];
                data.map(item => {
                    this.item['permission_id'].push(item.id);
                });
            }
        }
    }
</script>

<style>

    #exampleModal {
        display: block;
    }
</style>
