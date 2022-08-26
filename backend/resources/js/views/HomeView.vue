<template>
  <div class="main-wrapper">
    <div class="wrapper">
      <h1>Привет!</h1>
      <h2>Меня зовут Елдар и это мой дипломный проект для Компьютерной академии ШАГ.</h2>
      <h2>Добро пожаловать на сайт разработанный мною.</h2>
      <h2>Этот интернет магазин, является неким шаблоном <br> который я скорее всего буду в будущем использовать.</h2>
      <h2>Хотелось бы сказать отдельное спасибо академии т.к. благодаря знаниям, <br> которые она дала мне академия меня приглашают на множество работ и щас я начинаю свой бизнес</h2>
      <h2>К сожелению с дизайном у меня проблемы, но зато я хорошо умею кодить.</h2>
      <h3>Админ-панель данного сайта находится по роуту /admin, а данные для авторизации admin admin</h3>
    </div>
  </div>
</template>

<script>
import Header from '../components/Header.vue'
import axios from 'axios'
import ProductItem from '../components/ProductItem.vue'
export default {
  name:'HomeView',
  data() {
    return {
      products: []
    }
  },
  components:{
    ProductItem,
    Header
  },
  mounted() {
    axios
        .get('/api/product')
        .then(response => (this.products = response.data));
  },
}
</script>

<style lang="sass" scoped>
  .main-wrapper
    width: 100%
    display: flex
    flex-direction: column
    align-items: center
    .wrapper
      width: 60%
      color: black
      h1
        margin-top: 2vh
        color: red
      h2
        margin-top: 3vh
        margin-bottom: 1vh
</style>
