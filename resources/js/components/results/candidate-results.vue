<template>
    <div class="results_candidates">
        <div class="animate__animated animate__zoomIn">
                <div>
  <b-card no-body class="overflow-hidden" style="">
    <b-row no-gutters>
      <b-col md="3">
        <b-card-img src="https://picsum.photos/400/400/?image=20" alt="Image" class="rounded-0 p-2"></b-card-img>
<div>
</div>
      </b-col>
      <b-col md="9">
        <b-card-body title="Augustine Wletsu" class="mt-3 font-weight-light">
          <b-card-text>
            <div class="vote_progress_bar">
                  <b-progress :value="value" :max="max" show-progress animated></b-progress>
            </div>
          </b-card-text>
        </b-card-body>
      </b-col>
    </b-row>
  </b-card>
</div>
        </div>
    </div>
</template>

<script>
export default {
  data(){
    return{
        isVoteButtonClicked: false,
        value: 45,
        max: 100
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