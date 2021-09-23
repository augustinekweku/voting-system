<template>
    <div class="candidates">
        <div class="animate__animated animate__zoomIn">
  <div class="row  row-cols-3">
    <div class="col mb-4">
      <div class="image_container">
      <img src="/images/candidate-1.jpeg"  alt="Avatar" class="image" style="width:100%">
        <div class="middle">
          <div v-if="!isVoteButtonClicked" @click="confirmVote" class="text">Vote</div>
          <div v-if="isVoteButtonClicked"  class="text confirm_button">Confirm</div>
        </div>
        <div class="bottom-info bg-white">
        <div class="caption bg-white">
          <h5 class="name font-weight-light px-2 pt-2">Derek Fisher</h5>
          <p class="nickname font-weight-lighter px-2 ">Derek the leader</p>
        </div>
        <div class="card_title">
          <h6 class="px-2 py-2">Blue Team</h6>
        </div>
        </div>
      </div>
    </div>

  </div>
</div>
    </div>
</template>

<script>
export default {
  data(){
    return{
        isVoteButtonClicked: false
    }
  },
  methods:{
    confirmVote(){
        this.vote =  "Confirm"
        this.confirm_button = "confirm_button"
        this.isVoteButtonClicked = true
    }
  }
}
</script>

<style scoped>
.confirm_button{
  background: chartreuse;
}
.card_title{
  background: slateblue;
  border-radius: 0 0 7px 7px;
  color: white;
}

.image_container {
  position: relative;
  width: 100%;
  box-shadow: -2px -2px 26px -2px rgba(0,0,0,0.62);
  border-radius: 7px;
  background: rgba(0,0,0,0.7);
  opacity: 1;

}

.image {
  border-radius: 7px 7px 0 0  ;
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
  height: 200px;
  object-fit: cover;
  background-position: center center;
}

.middle {
  border-radius: 5px;
  border: 2px solid white;
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.image_container:hover .image {
  opacity: 0.3;
  background: black;
}

.image_container:hover .middle {
  opacity: 1;
}

.text {
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}

</style>