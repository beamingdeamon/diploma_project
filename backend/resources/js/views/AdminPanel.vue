<template>
  <div class="admin_wrapper">
    <form v-show="!this.is_auth" class="login">
      <legend class="login-legend">Login</legend>
      <input type="text" v-model="username" placeholder="Username">
      <input type="password" v-model="password" placeholder="Password">
      <button @click="Login">Login</button>
    </form>
    <div class="template" v-show="this.is_auth">
        <form class="create_category">
          <legend>Создать Категорию</legend>
          <input type="text" placeholder="Название" v-model="category_name">
          <button @click="CreateCategory">Создать</button>
        </form>
        <form class="create_product">
          <legend>Создать Продукт</legend>
          <input type="text" placeholder="Название" v-model="product_name" required>
          <input type="text" placeholder="Ценна" v-model="product_price" required>
          <input type="text" placeholder="Характеристика 1" v-model="first_char" required>
          <input type="text" placeholder="Характеристика 2" v-model="second_char" required>
          <input type="text" placeholder="Характеристика 3" v-model="third_char" required>
          <input type="text" placeholder="Характеристика 4" v-model="fourth_char" required>
          <input type="text" placeholder="Характеристика 5" v-model="fivth_char" required>
          <input type="text" placeholder="Название категории" v-model="product_category"  required>
          <button @click="CreateProduct">Создать</button>
        </form>
        <form>
          <legend>Добавить картинку</legend>
          <input type="text" placeholder="Id продукта" v-model="product_id">
          <input type="file" name="image" id="file_input" @change="CreateImage">
          Сначала id потом файл
        </form>
        <form class="delete_product">
         <legend>Удалить продукт</legend> 
          <input type="text" placeholder="Id продукта" v-model="delete_product">
          <button @click="DeleteProduct">Удалить</button>
         <legend>Удалить Категорию</legend> 
          <input type="text" placeholder="Id категории" v-model="delete_category">
          <button @click="DeleteCategory">Удалить</button>
        </form>
        <button @click="Modal" class="req-button">Посмотреть заявки</button>
        <div id="admin_modal">
          <a @click="Modalback">back</a>
          <div class="requests">
            <div class="request_item"
              v-for="item in requests" 
              :key="item.id">
               <span class="city">г.{{item.city}} <br>Адрес: {{item.address}}</span> <div class="user_info">{{item.buy_name}}<br>{{item.number}}</div>Товары: <div class="req_product"><span v-for="product in item.requestproduct" :key="product.id" class="product_wrapper">{{product.product.name}}</span></div><div class="total">Итого: {{item.total_price}}₸</div> 
              </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      first_char: null,
      second_char: null,
      third_char: null,
      fourth_char: null,
      fivth_char: null,
      delete_category: null,
      delete_product: null,
      product_id: null,
      requests: [],
      product_name: null,
      product_price: 0,
      product_category: null,
      category_name: null,
      username: null,
      password: null,
      admin_username: 'admin',
      admin_password: 'admin',
      is_auth: false,
      file: null
    }
  },
  methods: {
    Login(){
      if(this.username === this.admin_username && this.password === this.admin_password){
        this.is_auth = true;
      }else{
        alert('Не правильный логин или пароль');
      }
    },
    CreateCategory(){
      axios.post('/api/category', {
          name: this.category_name
          }) .then(function (response) {
          console.log(response);
        })
        debugger;
    },
    CreateProduct(){
      axios.post('/api/product', {
          name: this.product_name,
          price: this.product_price,
          first_char: this.first_char,
          second_char: this.second_char,
          third_char: this.third_char,
          fourth_char: this.fourth_char,
          fivth_char: this.fivth_char,
          category: this.product_category
          }) .then(function (response) {
          console.log(response);
        })
    },
    CreateImage(event){
      debugger;
      let bodyFormData = new FormData()
      bodyFormData.append('image', event.target.files[0])
      axios({
          method: 'post', 
          url:  '/api/create_image/'+ this.product_id, 
          data: bodyFormData,
          headers: { "Content-Type": "multipart/form-data" },
      })
    },
    DeleteProduct(){
      axios.delete('/api/product/'+this.delete_product);
    },
    DeleteCategory(){
      axios.delete('/api/category/'+this.delete_category);
    },
    Modal(){
      document.getElementById("admin_modal").style.visibility = "visible";
    },Modalback(){
      document.getElementById("admin_modal").style.visibility = "hidden";
    }
  },mounted() {
    axios
      .get('/api/request')
      .then(response => (this.requests = response.data));
  },
}
</script>

<style lang="sass" scoped>
  .admin_wrapper
    width: 100vw
    display: flex
    align-items: center
    justify-content: center
    .login
      margin-top: 35vh
    .req-button
      width: 40%
      margin-top: 5vh
      margin-bottom: 10vh
    .create_category
      margin-top: 10vh
      margin-top: 4vh
      width: 40% !important
    .create_product
      margin-top: 12vh
      width: 70% !important
      height: 60vh
    .delete_product
      margin-top: 12vh
      width: 60% !important
      legend
        font-size: 1.2em
        padding-bottom: 2vh
    form
      width: 23%
      height: 40%
      color: white
      display: flex
      justify-content: center
      align-items: center
      flex-direction: column
      .login-legend
        margin-left: 5vw
      legend
        padding-bottom: 4vh
        font-size: 2em
      input
        margin-bottom: 2vh
    .template
      width: 90%
      height: 100vh
      display: flex
      flex-direction: column
      #admin_modal
        visibility: hidden
        width: 100vw
        height: 100vh
        position: fixed
        background-color: white
        display: flex
        align-items: center
        justify-content: center
        .requests
          width: 80%
          height: 90%
          background-color: #cacaca
          overflow-y: auto
          .request_item
            width: 100%
            height: 8vh
            margin-top: 2vh
            border-bottom: 1px solid black
            display: flex
            flex-direction: row
            .city
              margin-left: 3vw
              width: 20%
            .user_info
              width: 20%
            .req_product
              width: 30%
              height: 80%
              overflow-y: auto
              .product_wrapper
                margin-left: 2vw
            .total
              margin-left: 2vw
        a
          cursor: pointer
          color: red
          text-decoration: underline
          font-size: 2em
          left: 2%
          top: 3%
          position: absolute
</style>
