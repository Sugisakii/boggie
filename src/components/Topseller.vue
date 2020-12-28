<template>
  <div>
    <h3 class="nk-decorated-h-2">
      <span><span class="text-main-1">top 10</span> best seller</span>
    </h3>
    <div class="">
      <div class="text-center">
        <carousel
          :perPageCustom="[
            [768, 4],
            [1024, 6],
          ]"
          :autoplay="true"
          :autoplayTimeout="3000"
          :loop="true"
          :minSwipeDistance="4"
        >
          <slide v-for="(item, index) in items" :key="index">
            <div
              class="d-flex d-md-flex d-lg-flex justify-content-center justify-content-md-center justify-content-lg-center nk-product-cat-3"
            >
              <div
                class="nk-product-image"
                :style="{ backgroundImage: `url('${item.foto}')` }"
              ></div>
              <div
                style="
                  margin-top: -180px;
                  z-index: 1;
                  width: 115px;
                  height: 180px;
                  position: relative;
                "
                class="nk-labeles"
              >
                <div style="position: absolute; bottom: 0; width: 100%">
                  <h3 class="nk-product-title h5">{{ item.name }}</h3>
                  <h3 class="nk-product-title h5">${{ item.precio }}</h3>
                </div>
              </div>
              <a
                class="nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-main-1"
                href="javascript:void(0)"
                >añadir al carro</a
              >
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
          name: "EL SR de LOS ITEMS",
          foto:
            "https://d50m6q67g4bn3.cloudfront.net/Shop_2/New%20300x470/WoT/excelsior.jpg",
          precio: 6,
        },
        {
          name: "CS:GO AWP [Fever Dream]",
          foto: "https://d50m6q67g4bn3.cloudfront.net/Shop_2/New%20300x470/CS%3AGO/awp_fever-dream.jpg",
          precio: 7,
        },
        {
          name: "LoL 650 RP",
          foto: "https://cdn.faceit.com/Shop/LoL/Riot+Points+650.jpg",
          precio: 8,
        },
        {
          name: "Pack mia khalifa",
          foto: "https://i1.sndcdn.com/artworks-000104677579-vp7x4d-t500x500.jpg",
          precio: 10,
        },
        {
          name: "Dota 2 Clarity Keychain",
          foto: "https://cdn.faceit.com/Shop/Hardware/300x470/Fragstore_Clarity_Keychain.jpg",
          precio: 15,
        },
        {
          name: "Timik-47",
          foto: "https://cdn.faceit.com/Shop/Dirty+Bomb/AssaultRifle_04_FaceIt_Pristine.jpg",
          precio: 18,
        },
      ],
    };
  },
  props: {},
  methods: {},
};
</script>

<style scoped>
.nk-product-image {
  background-size: auto;
  background-repeat: round;
  width: 160px;
  height: 208px;
  opacity: 1;
}
.nk-labeles {
  opacity: 0;
}
.nk-labeles:hover {
  opacity: 1;
}
.nk-product-cat-3 {
  max-width: none;
}
</style>
