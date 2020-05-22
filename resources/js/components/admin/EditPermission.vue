<template>
    <div>
        <div class="modal modal-active fade show" id="exampleModal" tabindex="-1"
             role="dialog" @click.self="$emit('hideModal')">
            <div class="modal-dialog" :class="classes" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ویرایش مجوز</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                @click="$emit('hideModal')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">عنوان</label>
                                    <input type="text" id="name" class="form-control" v-model="item.name"
                                           placeholder="نام مجوز را وارد کنید، برای مثال: admin_index"
                                           :class="{'is-invalid': errors.name}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="label">برچسب مجوز</label>
                                    <input type="text" id="label" class="form-control" v-model="item.label"
                                           placeholder="توضیح مجوز را وارد کنید، برای مثال: لیست مدیران"
                                           :class="{'is-invalid': errors.label}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guard_name">نوع کاربر</label>
                                    <select class="form-control" name="guard_name" id="guard_name"
                                            :class="{'is-invalid': errors.guard_name}">
                                        <option v-if="!item.guard_name">نوع کاربر را انتخاب کنید</option>
                                        <option v-for="guard in guards" v-model="item.guard_name">{{guard}}</option>
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
        name: 'EditPermission',
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
                guards: ['admin', 'user', 'doctor', 'pharmacy'],
                errors: []
            }
        },
        created() {
            this.item = Object.assign({}, this.row);
        },
        methods: {
            submit() {
                window.axios.put('/admin/permission/' + this.row.id, this.item)
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
            }
        }
    }
</script>

<style>

    #exampleModal {
        display: block;
    }
</style>