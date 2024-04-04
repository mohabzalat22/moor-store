<template>
    <p :title="title" class="display-6 text-center py-4 mt-5 text-capitalize">{{ title }}</p>
</template>

<script>
export default{
    props:['title'],
}
</script>