<template>
    <div class="list-user">
        <table class="tbl-list-user">
            <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, key) in userData">
                <td>{{key}}</td>
                <td><a @click="selectUser(user, key)">{{user.name}}</a></td>
                <td>{{user.age}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userData: [
                    {'name': 'TNgoc', 'age': '22'},
                    {'name': 'DAnh', 'age': '19'},
                    {'name': 'QNhu', 'age': '19'}
                ],
                number: 1410,
                string: 'MTD'
            }
        },
        methods: {
            selectUser(user, key) {
                this.$emit('userSelected', user, this.number, this.string, key);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .tbl-list-user {
        width: 50%;
    }
</style>
