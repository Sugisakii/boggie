<template>
  <div>
    <h3 class="nk-decorated-h-2">
      <span><span class="text-main-1">top 10</span> best seller</span>
    </h3>
    <div class="">
      <div class="text-center">
        <carousel
          :perPageCustom="[
            [768, 3],
            [1024, 5],
          ]"
          :autoplay="true"
          :autoplayTimeout="3000"
          :loop="true"
        >
          <slide v-for="(item, index) in items" :key="index">
            <div class="nk-product-cat-3">
              <div class="nk-product-image">
                <img :src="item.foto" />
              </div>
              <div class="nk-product-cont">
                <div class="nk-gap-1"></div>
                <h3 class="nk-product-title h5">{{ item.name }}</h3>
                <div class="nk-gap"></div>
                <div class="nk-product-price">
                  <label>{{ item.precio }}$</label>
                </div>
                <a
                  href="javascript:void(0)"
                  class="nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-main-1"
                >
                  Comprar
                </a>
              </div>
            </div>
          </slide>
        </carousel>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Topseller",
  created() {},
  data() {
    return {
      items: [
        {
          name: "Item 1",
          foto: "",
          precio: 6,
        },
        {
          name: "Item 2",
          foto: "",
          precio: 7,
        },
        {
          name: "Item 3",
          foto: "",
          precio: 8,
        },
        {
          name: "Item 4",
          foto: "",
          precio: 6,
        },
        {
          name: "Item 5",
          foto: "",
          precio: 6,
        },
        {
          name: "Item 6",
          foto: "",
          precio: 6,
        },
      ],
    };
  },
  props: {},
  methods: {},
};
</script>

<style scoped></style>
