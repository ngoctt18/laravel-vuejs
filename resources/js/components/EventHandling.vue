<template>
    <div class="event-handling">
        <div>Current Number: {{ counter }}</div>
        <button @click="increaseCounter(1)">CLick</button>
        <div class="event-handling-son">
            <div @click="alertHello">
                <button @click.stop="alertWelcome">CLick</button>
            </div>
        </div>
        <div class="event-handling-form">
            <form>
                <button type="submit" @click.once.prevent="sayWelcome">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                counter: 0
            }
        },
        methods: {
            increaseCounter(number) {
                this.counter += number;
            },
            alertHello() {
                alert('Hello')
            },
            alertWelcome() {
                alert('Welcome button')
            },
            sayWelcome() {
                alert(1)
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
