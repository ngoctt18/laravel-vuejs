<template>
    <div class="form-input-binding">
        <div class="text">
            {{ input_txt }}
        </div>
        <div class="input-form">
            <input type="text" v-model.lazy.trim="input_txt" name="">
        </div>
        <br>
        <div class="text">
            {{ checkbox }}
        </div>
        <div class="input-form">
            <input type="checkbox" v-model="checkbox" name="">
        </div>
        <br>
        <div class="text">
            {{ radio }}
        </div>
        <div class="input-form">
            <input type="radio" v-model="radio" value="one">
            <input type="radio" v-model="radio" value="two">
        </div>
        <br>
        <div class="text">
            {{ select }}
        </div>
        <div class="input-form">
            <select v-model="select">
                <option disabled="">Choose one</option>
                <option :value="values.one">One</option>
                <option :value="values.two">Two</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                input_txt: '',
                checkbox: '',
                radio: '',
                select: '',
                values: {
                    one: 'This is One',
                    two: 'This is Two'
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
