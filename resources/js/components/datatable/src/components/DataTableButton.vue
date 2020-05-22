<template>
    <button :class="buttonClasses" @click.self.stop="clickFunction" v-if="access">
        <span :class="deleteBox" v-if="span" v-click-outside="no">
            <p>مطمئن هستید؟</p>
            <button type="button" class="btn btn-sm btn-success" @click.prevent="yes">بله</button>
            <button type="button" class="btn btn-sm btn-secondary" @click.prevent="no">خیر</button>
        </span>
        <i :class="iconClasses" aria-hidden="true" @click.self.stop="clickFunction"></i>
        {{ buttonName }}
    </button>
</template>

<script>
    import vClickOutside from 'v-click-outside';
    export default {
        name: 'DataTableButton',
        props: {
            data: {},
            name: {},
            href: {
                type: String,
                default: null
            },
            method: {
                type: String,
                default: null
            },
            handler: {
                type: String,
                default: false
            },
            modalComponent: {
                type: String,
                default: null
            },
            access: {
                type: Boolean,
                default: true
            },
            classes: {
                type: Object,
                default: () => ({
                    button:{
                        'btn': true,
                        'btn-primary': true,
                        'btn-sm': true,
                    },
                    icon:{
                        'fa': true,
                        'fa-eye': true,
                    }
                }),
            },
            // buttonClass: {
            //     type: Object,
            //     default: () => ({
            //         'btn': true,
            //         'btn-primary': true,
            //         'btn-sm': true,
            //     }),
            // },
            // iconClass: {
            //     type: Object,
            //     default: () => ({
            //         'fa': true,
            //         'fa-eye': true,
            //     }),
            // },
        },
        directives: {
            clickOutside: vClickOutside.directive
        },
        data() {
            return {
                span: false,
                buttonClass: {},
                iconClass: {},
                deleteBox: {'deleteBox': true},
                resolvePromise: null,
                rejectPromise: null
            }
        },
        created() {
            this.buttonClass = Object.assign({}, this.classes.button);
            this.iconClass = Object.assign({}, this.classes.icon);
        },
        computed: {
            buttonName() {
                let data = this.data;
                if (/\?/.test(this.name)) {
                    return eval('data.' + this.name);
                }
                return this.name;
            },
            buttonClasses() {
                let data = this.data;
                let classes = Object.assign({},this.buttonClass);
                Object.keys(classes).map(item => {
                    if (/\?/.test(classes[item])){
                        classes[item] = eval('data.' + classes[item]);
                    }
                });
                return classes;
            },
            iconClasses() {
                let data = this.data;
                let classes = Object.assign({},this.iconClass);
                Object.keys(classes).map(item => {
                    if (/\?/.test(classes[item])){
                        classes[item] = eval('data.' + classes[item]);
                    }
                });
                return classes;
            }
        },
        methods: {
            clickFunction() {
                if (this.handler == 'modal' && this.modalComponent) {
                    this.$parent.$emit('selectedModal', {data: this.data, modalComponent: this.modalComponent});
                }

                if (this.handler == 'page' && this.href) {
                    window.location.href = this.href + '/' + this.data.id;
                }

                if (this.handler == 'action' && this.method) {
                    let promise = null;
                    if (this.method == 'delete') {
                        promise = new Promise((resolve, reject) => {
                            this.span = true;
                            this.buttonClass = Object.assign({}, { ...this.buttonClass,...{'delete': true, 'selected': true}});
                            this.resolvePromise = flag => {
                                resolve(flag);
                            };

                            this.rejectPromise = error => {
                                reject(error);
                            };
                        });

                        promise.then(response => {
                            this.axiosAction();
                        }).catch(error => {
                            this.hideBoxDelete();
                        });
                    } else {
                        this.axiosAction();
                    }
                }
            },
            reloadTable() {
                this.$parent.$emit('changed');
            },
            yes() {
                this.$set(this.deleteBox, 'loading', true);
                setTimeout(() => {
                    this.$set(this.deleteBox, 'deleted', true);
                    setTimeout(() => {
                        setTimeout(() => {
                            this.resolvePromise(true);
                        }, 1000);
                    }, 1000);
                }, 1000);
            },
            no() {
                this.rejectPromise(false);
            },
            axiosAction() {
                axios({
                    method: this.method,
                    url: this.href + '/' + this.data.id,
                }).then(response => {
                    window.eventBus.$emit('flash', response.data);
                    if (response.data.code == 1) {
                        this.reloadTable();
                        if (this.method == 'delete') {
                            this.hideBoxDelete();
                        }
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            hideBoxDelete(){
                this.deleteBox = Object.assign({}, {...this.deleteBox,...{'loading': false, 'deleted': false}});
                this.buttonClass = Object.assign({}, {...this.buttonClass,...{'deleted': false,'selected': false}});
                setTimeout(() => {
                    this.span = false;
                }, 500);
            }
        }
    }
</script>

<style>
    .delete {
        box-shadow: 0px 0px 1px #213741;
        z-index: 100;
        position: relative;
        -webkit-transition: background 0.3s;
        -moz-transition: background 0.3s;
        -o-transition: background 0.3s;
        transition: background 0.3s;
    }

    .delete:hover {
        background-color: #713031;
    }

    .delete.selected {
        background-color: #713031;
    }

    .delete.selected .deleteBox {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=$opacityIE)";
        filter: alpha(opacity=100);
        width: 275px;
        height: 100px;
        overflow: visible;
        -webkit-transition: opacity 0.3s, top 0.3s, width 0s, height 0s;
        -webkit-transition-delay: 0s, 0s, 0s, 0s;
        -moz-transition: opacity 0.3s, top 0.3s, width 0s 0s, height 0s 0s;
        -o-transition: opacity 0.3s, top 0.3s, width 0s 0s, height 0s 0s;
        transition: opacity 0.3s, top 0.3s, width 0s 0s, height 0s 0s;
    }

    .delete .deleteBox {
        position: absolute;
        overflow: hidden;
        background: #1C242B;
        width: 0px;
        height: 0px;
        border-radius: 5px;
        text-indent: 0px;
        cursor: default;
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=$opacityIE)";
        filter: alpha(opacity=0);
        -webkit-transition: opacity 0.3s, top 0.3s, width 0s, height 0s;
        -webkit-transition-delay: 0s, 0s, 0.3s, 0.3s;
        -moz-transition: opacity 0.3s, top 0.3s, width 0s 0.3s, height 0s 0.3s;
        -o-transition: opacity 0.3s, top 0.3s, width 0s 0.3s, height 0s 0.3s;
        transition: opacity 0.3s, top 0.3s, width 0s 0.3s, height 0s 0.3s;
        z-index: 2;
    }

    .delete.box-top .deleteBox{
        left: 50%;
        bottom: 0;
        transform: translate(-50%, -40%);
    }

    .delete.box-right .deleteBox{
        right: 0;
        top: 50%;
        transform: translate(103%,-50%);
    }

    .delete.box-top .deleteBox:after {
        content: '';
        display: block;
        width: 0px;
        left: 0px;
        border-top: 5px solid #1C242B;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        position: absolute;
        bottom: -5px;
        left: 50%;
        margin-left: -5px;
    }

    .delete.box-right .deleteBox:after {
        content: '';
        display: block;
        width: 0px;
        border-right: 5px solid #1C242B;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        position: absolute;
        left: -5px;
        top: 50%;
        margin-top: -5px;
    }

    .delete .deleteBox p {
        margin: 13px 0;
    }

    .delete .deleteBox button {
        display: -moz-inline-stack;
        display: inline-block;
        vertical-align: middle;
        zoom: 1;
        margin: 0 10px;
        width: 80px;
        cursor: pointer;
        -webkit-transition: background 0.3s;
        -moz-transition: background 0.3s;
        -o-transition: background 0.3s;
        transition: background 0.3s;
    }

    .delete .deleteBox .confirm {
        background: #38B87C;
    }

    .delete .deleteBox .confirm:hover {
        background: #2c9162;
    }

    .delete .deleteBox .cancel {
        background: #696F73;
    }

    .delete .deleteBox .cancel:hover {
        background: #515558;
    }

    .delete .deleteBox:before {
        content: 'در حال انجام ...';
        display: block;
        position: absolute;
        top: 0px;
        right: 0px;
        width: 0px;
        height: 0px;
        text-align: center;
        line-height: 60px;
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=$opacityIE)";
        filter: alpha(opacity=0);
        border-radius: 5px;
        background: #1c242b url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiIgd2lkdGg9IjMyIiBoZWlnaHQ9IjMyIiBmaWxsPSJ3aGl0ZSI+CiAgPGNpcmNsZSB0cmFuc2Zvcm09InRyYW5zbGF0ZSg4IDApIiBjeD0iMCIgY3k9IjE2IiByPSIwIj4gCiAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJyIiB2YWx1ZXM9IjA7IDQ7IDA7IDAiIGR1cj0iMS4ycyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIGJlZ2luPSIwIgogICAgICBrZXl0aW1lcz0iMDswLjI7MC43OzEiIGtleVNwbGluZXM9IjAuMiAwLjIgMC40IDAuODswLjIgMC42IDAuNCAwLjg7MC4yIDAuNiAwLjQgMC44IiBjYWxjTW9kZT0ic3BsaW5lIiAvPgogIDwvY2lyY2xlPgogIDxjaXJjbGUgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTYgMCkiIGN4PSIwIiBjeT0iMTYiIHI9IjAiPiAKICAgIDxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9InIiIHZhbHVlcz0iMDsgNDsgMDsgMCIgZHVyPSIxLjJzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSIgYmVnaW49IjAuMyIKICAgICAga2V5dGltZXM9IjA7MC4yOzAuNzsxIiBrZXlTcGxpbmVzPSIwLjIgMC4yIDAuNCAwLjg7MC4yIDAuNiAwLjQgMC44OzAuMiAwLjYgMC40IDAuOCIgY2FsY01vZGU9InNwbGluZSIgLz4KICA8L2NpcmNsZT4KICA8Y2lyY2xlIHRyYW5zZm9ybT0idHJhbnNsYXRlKDI0IDApIiBjeD0iMCIgY3k9IjE2IiByPSIwIj4gCiAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJyIiB2YWx1ZXM9IjA7IDQ7IDA7IDAiIGR1cj0iMS4ycyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIGJlZ2luPSIwLjYiCiAgICAgIGtleXRpbWVzPSIwOzAuMjswLjc7MSIga2V5U3BsaW5lcz0iMC4yIDAuMiAwLjQgMC44OzAuMiAwLjYgMC40IDAuODswLjIgMC42IDAuNCAwLjgiIGNhbGNNb2RlPSJzcGxpbmUiIC8+CiAgPC9jaXJjbGU+Cjwvc3ZnPg==") no-repeat center 50px;
        -webkit-transition: opacity 0.3s, top 0.3s, left 0.3s;
        -moz-transition: opacity 0.3s, top 0.3s, left 0.3s;
        -o-transition: opacity 0.3s, top 0.3s, left 0.3s;
        transition: opacity 0.3s, top 0.3s, left 0.3s;
    }

    .delete .deleteBox.loading:before {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=$opacityIE)";
        filter: alpha(opacity=100);
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
    }

    .delete .deleteBox.deleted:before {
        content: 'انجام شد';
        background: #1c242b url("data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoKCSB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiB4bWw6c3BhY2U9InByZXNlcnZlIj4KCjxwb2x5Z29uIGlkPSJjaGVjay1tYXJrLTctaWNvbiIgcG9pbnRzPSI1MCwyNDcuNzg3IDc3LjA5LDIxOS44MzMgMjA5Ljg1OSwyOTkuMjIyIDQzOC43ODcsODEuMjQ1IDQ2MiwxMDQuNSAyMTkuODYzLDQzMC43NTUgIiBmaWxsPSIjRkZGIi8+Cgo8L3N2Zz4=") no-repeat center 55px;
        background-size: 20px 20px;
    }
</style>
