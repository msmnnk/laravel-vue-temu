<template>
    <div class="hero-banner">
      <div class="container">
        <h1 class="display-4">{{ title }}</h1>
        <p class="lead">{{ subtitle }}</p>
        <button class="btn btn-primary">{{ buttonLabel }}</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
        title: {
            required: true,
            type: String
        },
        subtitle: {
            required: true,
            type: String
        },
        buttonLabel: {
            required: true,
            type: String
        }
    }
  };
  </script>
  
  <style scoped>
  .hero-banner {
    background: linear-gradient(to bottom, #D4DFC7, #96C0B7);
    font-family: Verdana, sans-serif;
    color: black;
    padding: 100px 0;
    text-align: center;
  }
  
  .container {
    max-width: 800px;
    margin: 0 auto;
  }
  </style>
  