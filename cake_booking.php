<style>
  .cake_img {
    cursor: pointer;
  }
  label{
    color:white;
  }
 

</style>
<div
  style="
    display: flex;
    position: fixed;
    z-index: 7;
    top: 0;
    height: 100vh;
    width: 100vw;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.6);
  "
>
  <div
    style="
      background-color: rgba(0, 0, 0, 0.9);
      height: 80%;
      width: 43vw;
      padding: 2rem 4rem;
    "
  >
    <form
      style="display: flex; justify-content: end; position: relative"
    >
      <a
        href="index.php?cake=cancle"
        title='Cancle Cake'
        style="
          text-decoration: none;
          color: white;
          position: absolute;
          top: -22px;
          right: -45px;
        "
        ><i class="fa-solid fa-x"></i
      ></a>
    </form>
    <form style="display: flex; flex-direction: column" action="index.php" method="POST">
      <div
        style="
          display: flex;
          justify-content: space-around;
          align-items: center;
          flex-wrap: wrap;
        "
      >
        <p
          style="
            width: 100%;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            color:white;
          "
        >
          Customize your Birthday Cake
        </p>
        <p style="width: 100%; text-align: center; color: rgb(173, 173, 173)">
          Select Shape for Cake
        </p>
        <div
          class="inp"
          style="width: 30%; display: flex; justify-content: center"
        >
          <input type="radio" name="cake_shape" value="heart" id="heart" hidden />
          <label for="heart" style="position: relative"
            ><img
              class="cake_img animate_cake"
              width="70"
              height="70"
              src="images/heart.png"
              alt=""
              onclick="select(0)"
            />
            <span
              class="s_text"
              style="position: absolute; top: 40%; left: 27%; font-size: 0.5rem;color:red"
              ></span
            >
          </label>
        </div>

        <div
          class="inp"
          style="width: 30%; display: flex; justify-content: center"
        >
          <input type="radio" name="cake_shape" value="square" id="square" hidden />
          <label for="square" style="position: relative"
            ><img
              class="cake_img"
              width="50"
              height="50"
              src="images/square.png"
              alt=""
              onclick="select(1)"
            />
            <span
              class="s_text"
              style="position: absolute; top: 40%; left: 19%; font-size: 0.5rem;color:red"
              ></span
            >
          </label>
        </div>

        <div
          class="inp"
          style="width: 30%; display: flex; justify-content: center"
        >
          <input type="radio" name="cake_shape" value="round" id="round" hidden />
          <label for="round" style="position: relative"
            ><img
              class="cake_img"
              width="70"
              height="70"
              src="images/round.png"
              alt=""
              onclick="select(2)"
            />
            <span
              class="s_text"
              style="position: absolute; top: 40%; left: 27%; font-size: 0.5rem;color:red"
              ></span
            >
          </label>
        </div>
      </div>
      <div
        class="shapes"
        style="
          display: flex;
          justify-content: space-around;
          align-items: center;
          flex-wrap: wrap;
        "
      >
        <p
          style="
            width: 100%;
            margin-top: 2rem;
            text-align: center;
            color: rgb(173, 173, 173);
          "
        >
          Select Flavors for Cake
        </p>

        <div class="inp" style="display: flex; justify-content: center">
          <input type="radio" name="Flavors" value="Vanilla" id="Vanilla" />
          <label for="Vanilla">&nbsp; Vanilla</label>
        </div>

        <div class="inp" style="display: flex; justify-content: center">
          <input type="radio" name="Flavors" value="Chocolate" id="Chocolate" />
          <label for="Chocolate">&nbsp; Chocolate</label>
        </div>

        <div class="inp" style="display: flex; justify-content: center">
          <input
            type="radio"
            name="Flavors"
            value="Strawberry"
            id="Strawberry"
          />
          <label for="Strawberry">&nbsp; Strawberry</label>
        </div>

        <div class="inp" style="display: flex; justify-content: center">
          <input type="radio" name="Flavors" value="Coconut" id="Coconut" />
          <label for="Coconut">&nbsp; Coconut</label>
        </div>
      </div>

      <div class="shapes" style="margin: 2rem 0">
        <div class="inp" style="display: flex">
          <input
            style="
              width: 100%;
              height: 3rem;
              outline: none;
              border: 1px solid rgb(177, 177, 177);
              box-shadow: 0px 5px 5px 0 rgb(177, 177, 177);
              padding-left: 1rem;
            "
            type="input"
            name="pname"
            placeholder="Person Name On Cake"
          />
        </div>
      </div>

      <div class="shapes">
        <div class="inp" style="display: flex">
          <input
          value="Order"
            type="submit"
            name="submit_cake"
            style="
              background-color: rgb(55 55 55);
              border: none;
              padding: 0.5rem 1.5rem;
              color: white;
            "
          />
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function select(i){
    for(let j=0;j<3;j++){
      document.getElementsByClassName("s_text")[j].innerHTML='';
    }
    document.getElementsByClassName("s_text")[i].innerHTML='Selected';
  }
</script>
