<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet"> -->
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example">

    <!-- Example Code -->
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Accordion Item #1
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
          <table style="width: 100%;">
                    <thead>
                        <tr style="background-color:#ddd">
                            <th rowspan="2"></th>
                            <th colspan="8">CLO</th>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.Programing1 - print</td>
                            <td>25</td>
                            <td></td>
                            <td></td>
                            <td>25</td>
                            <td></td>
                            <td>25</td>
                            <td></td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>2.Programing2 - if else</td>
                            <td></td>
                            <td>25</td>
                            <td>25</td>
                            <td></td>
                            <td></td>
                            <td>25</td>
                            <td>25</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3.Programing3 - for loop</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>25</td>
                            <td>25</td>
                            <td>25</td>
                            <td></td>
                            <td>25</td>
                        </tr>
                    </tbody>
                </table>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h4>Midterm</h4>
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <table style="width: 100%;">
                    <thead>
                        <tr style="background-color:#ddd">
                            <th rowspan="2"></th>
                            <th colspan="8">CLO</th>
                        </tr>
                        <tr style="background-color:#ddd">
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.Programing1 - print</td>
                            <td>25</td>
                            <td></td>
                            <td></td>
                            <td>25</td>
                            <td></td>
                            <td>25</td>
                            <td></td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>2.Programing2 - if else</td>
                            <td></td>
                            <td>25</td>
                            <td>25</td>
                            <td></td>
                            <td></td>
                            <td>25</td>
                            <td>25</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3.Programing3 - for loop</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>25</td>
                            <td>25</td>
                            <td>25</td>
                            <td></td>
                            <td>25</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Accordion Item #3
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
    </div>
    
    <!-- End Example Code -->
  </body>
</html>