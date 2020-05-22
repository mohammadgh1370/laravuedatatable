<template>
    <span class="mytooltip tooltip-effect-1">
                        <img class="img-thumbnail img-tool-tip tooltip-item" :class="classes"
                             :src="data[name]" :alt="data[name]">
                        <span class="tooltip-content clearfix">
                            <img class='img-response' :src='data[name]' :alt='data[name]'>
                        </span>
                    </span>
</template>

<script>
    export default {
        name: "ImageTableToolTip",
        props: {
            data: {},
            name: {},
            classes: {},
        },
    }
</script>

<style scoped>
    .img-tool-tip {
        width: 200px;
    }
    .mytooltip {
        display: inline-block;
        position: relative;
        z-index: 999
    }

    .mytooltip .tooltip-content {
        display: none;
        position: absolute;
        z-index: 9999;
        width: 360px;
        border-radius: 5px;
        padding: 5px;
        text-align: left;
        font-size: 14px;
        line-height: 30px;
        -webkit-box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
        box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
        background: #2b2b2b;
        opacity: 0;
        cursor: default;
        pointer-events: none;
        left: 0;
        top: 50%;
        transform: translate(-103%,-50%);
    }

    .mytooltip .tooltip-content::after {
        content: '';
        display: block;
        width: 0px;
        border-left: 10px solid #2b2b2b;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        position: absolute;
        right: -10px;
        top: 50%;
        margin-top: -10px;
    }

    .mytooltip .tooltip-content img {
        position: relative;
        height: 140px;
        display: block;
        width: 100%;
    }

    .mytooltip:hover .tooltip-content {
        pointer-events: auto;
        opacity: 1;
        display: block;
    }
</style>
