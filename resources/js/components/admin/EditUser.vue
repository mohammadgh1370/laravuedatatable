<template>
    <div>
        <div class="modal modal-active fade show" id="exampleModal" tabindex="-1"
             role="dialog" @click.self="$emit('hideModal')">
            <div class="modal-dialog" :class="classes" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ویرایش کاربر</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                @click="$emit('hideModal')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">نام</label>
                                    <input type="text" id="name" class="form-control" v-model="item.name"
                                           placeholder="نام کاربر را وارد کنید"
                                           :class="{'is-invalid': errors.name}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="family">نام خانوادگی</label>
                                    <input type="text" id="family" class="form-control" v-model="item.family"
                                           placeholder="نام خانوادگی کاربر را وارد کنید"
                                           :class="{'is-invalid': errors.family}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>وضعیت</label>
                                    <select class="form-control" name="active" id="active"
                                            :class="{'is-invalid': errors.active}" v-model="item.active">
                                        <option value="true">فعال</option>
                                        <option value="false">غیرفعال</option>
                                    </select>
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
    export default {
        name: 'EditUser',
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
        data() {
            return {
                item: {},
                roles: [],
                errors: []
            }
        },
        created() {
            this.item = Object.assign({}, this.row);
        },
        methods: {
            submit() {
                window.axios.put('/admin/user/' + this.row.id, this.item)
                    .then(response => {
                        if (response.data.code === 1) {
                            this.$emit('changed');
                            this.$emit('hideModal');
                            window.eventBus.$emit('flash', response.data);
                        } else {
                            this.errors = response.data.data;
                            window.eventBus.$emit('flash', response.data);
                        }
                    });
            },
        }
    }
</script>

<style>

    #exampleModal {
        display: block;
    }
</style>
