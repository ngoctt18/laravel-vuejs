<template>
    <div class="user-detail">
        <div class="user-detail-container">
            <div class="user-key">
                key: {{ userDetailInfo.key }}
            </div>
            <div class="user-name" :lenght="Object.keys(userDetailInfo).length" :keys="Object.keys(userDetailInfo)"
                 :values="Object.values(userDetailInfo)">
                Name: {{ userDetailInfo.name }}
            </div>
            <div class="user-age">
                Age: {{ userDetailInfo.age }}
            </div>
            <div class="user-age">
                Text: {{ userDetailInfo.text }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            userDetailInfo: {
                type: Object
            }
        }
        // You can also write props: ['userDetailInfo'] but the above is recommended
    }
</script>

<style lang="scss" scoped>
</style>
