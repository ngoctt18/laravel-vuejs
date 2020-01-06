<template>
    <div class="my-component">
        <div><input type="text" v-model="input"></div>
        <div>{{showInput}}</div>
        <div>{{ message }}</div>
        <div>
            <button @click="changeMessage">Click me</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: 'This is my first component using binding data',
                turn: true,
                input: '',
            }
        },
        methods: {
            changeMessage() {
                if (this.turn) {
                    this.message = 'this is new message';
                    this.turn = false;
                } else {
                    this.turn = true;
                    this.message = 'this is new message 2'
                }
            }
        },
        computed: {
            showInput() {
                return this.input.split(' ').reverse().join(' ');
            }
        },
        watch: {
            message() {
                console.log('message changed')
            },
            showInput() {
                console.log(this.input);
                console.log(this.showInput);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .my-component {
        color: red;
    }
</style>
