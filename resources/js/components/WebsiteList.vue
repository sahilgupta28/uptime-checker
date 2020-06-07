<template>
  <div id="app">
    <div :class="{'red-error' : error}">123</div>
    <button type="button" @click="error = !erroe">Error</button>
  </div>
</template>

<script>
export default {
  name: "WebsietList",
  data: function() {
    return {
      error: false
    };
  }
};
</script>

<style>
</style>   