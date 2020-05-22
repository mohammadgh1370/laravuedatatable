<template>
    <transition-group name="toasts" tag="div" class="c-toasts">
        <template v-for="(toast,index) in toasts">
            <div :class="['c-toasts__item', 'c-toasts__item--' + toast.type]" :key="index">
                <span class="c-toasts__item-text">
                    <i :class="toast.icon"></i>
                    {{ toast.message }}
                </span>
                <span v-if="toast.sticky" class="mr-auto pointer" @click="removeToast(toast.id)" aria-hidden="true">&times;</span>
            </div>
        </template>
    </transition-group>
</template>

<script>


    let toastID = 0;
    export default {
        name: "FlashMessage",
        props: {flash: {type: Array | Object}, error: {type: Array | Object}, success: {type: Array | Object}},
        data() {
            return {
                toasts: [],
                states: {
                    '1': {type: 'success', icon: 'fa fa-check-circle fa-lg'},
                    '-1': {type: 'danger', icon: 'fa fa-times-circle fa-lg'},
                    '2': {type: 'warning', icon: 'fa fa-exclamation-triangle fa-lg'},
                    '0': {type: 'info', icon: 'fa fa-info-circle fa-lg'}
                },
            }
        },
        methods: {
            addToast({message, type = 'info', duration = 6000, sticky = false, icon}) {
                const id = toastID++;
                this.toasts.push({id, type, message, icon, sticky});

                if (!sticky) {
                    setTimeout(() => {
                        this.removeToast(id)
                    }, duration);
                }
            },

            removeToast(id) {
                this.toasts = this.toasts.filter(m => m.id !== id);
            }
        },
        mounted() {
            if (this.error.message) {
                this.error.message.forEach(item => {
                    this.addToast({
                        type: this.states[this.error.code].type,
                        message: item,
                        sticky: this.error.sticky,
                        icon: this.states[this.error.code].icon
                    });
                });
            }
            if (this.success) {
                this.addToast({
                    message: this.success.message,
                    type: this.states[this.success.code].type,
                    duration: this.success.message.duration,
                    sticky: this.success.sticky,
                    icon: this.states[this.success.code].icon,
                });
            }
            window.eventBus.$on('flash', data => {
                console.log(data)
                if (data.message instanceof Array)
                    data.message.forEach(item => {
                        this.addToast({
                            message: item,
                            type: this.states[this.error.code].type,
                            icon: this.states[this.error.code].icon
                        });
                    });
                else
                    this.addToast({
                        message: data.message,
                        type: this.states[data.code].type,
                        icon: this.states[data.code].icon
                    });
            });
        }
    }
</script>

<style scoped lang="scss">
    // Toasts transition
    .toasts-item {
        transition: all 0.5s;
    }

    .toasts-enter,
    .toasts-leave-to {
        opacity: 0;
        transform: scale(0.9);
    }

    .toasts-leave-active {
        position: absolute;
        z-index: -1;
    }

    // Component

    // Block
    .c-toasts {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 9999;
        width: 300px;
        /*pointer-events: none;*/
    }

    // Element
    .c-toasts__item {
        display: flex;
        align-items: center;
        width: 100%;
        margin-bottom: 10px;
        padding: 15px;
        border-radius: 5px;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .c-toasts__item-text {
        font-size: 14px;
        line-height: 1.5;
    }

    // Modifiers
    .c-toasts__item--success {
        background-color: #339900;
    }

    .c-toasts__item--danger {
        background-color: #cc3300;
    }

    .c-toasts__item--warning {
        background-color: #ffc107;
    }

    .c-toasts__item--info {
        background-color: #40a6ce;
    }

</style>