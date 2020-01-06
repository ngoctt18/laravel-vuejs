<template>
    <div class="binding-html">
        <div class="text-title" :class="{active: isActive, hide: isHide, bold: isBold}">
            This is text
        </div>
        <div>
            <button @click="isActive = !isActive">Active text</button>
        </div>
        <div>
            <button @click="isHide = !isHide">Hide text</button>
        </div>
        <div>
            <button @click="isBold = !isBold">Bold text</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isActive: false,
                isHide: false,
                isBold: false
            }
        }
    }
</script>

<style lang="scss" scoped>
    .active {
        color: red;
    }

    .hide {
        display: none;
    }

    .bold {
        font-weight: bold;
    }
</style>
