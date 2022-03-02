<template>
    <div>
        <span
            v-for="service in list"
            :key="`service-${service.id}`"
            class="badge badge-primary"
        >
            {{ service.name }}
        </span>
    </div>
</template>

<script>
export default {
    name: 'Services',
    props: {
        list:Array
    }
};
</script>

<style></style>
