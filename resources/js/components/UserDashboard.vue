<template>
    <div class="user-dashboard">
        <div class="list-user-comp">
            <h4>List User</h4>
            <!-- Listen event 'userSelected' emitted from child and process it using 'childrenSelectUser' -->
            <ListUser @userSelected="childrenSelectUser('this is test string', ...arguments)"></ListUser>
        </div>
        <div class="user-detail-comp">
            <h4>User Detail</h4>
            <!-- pass 'userSelectedFromChild', child will use props 'userDetailInfo' -->
            <UserDetail :userDetailInfo="userSelectedFromChild"></UserDetail>
        </div>
    </div>
</template>

<script>
    import ListUser from './ListUser.vue';
    import UserDetail from './UserDetail.vue';

    export default {
        data() {
            return {
                userSelectedFromChild: {},
            }
        },
        components: {
            ListUser,
            UserDetail
        },
        methods: {
            // Process event emitted from child
            childrenSelectUser(text, user, number, string, key) {
                console.log(number);
                console.log(string);
                console.log(key);
                console.log(text);
                this.userSelectedFromChild = user;
                this.userSelectedFromChild.key = key;
                this.userSelectedFromChild.text = text;
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
