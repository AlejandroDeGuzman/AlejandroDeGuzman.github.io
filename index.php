<?php
    require __DIR__ . '/includes/head.php'; 
?>
<!-- intro section -->
<section id="one">
        <div class="flex-container">
            <div id="text-content-one">
                <h1>&lt;Alejandro De Guzman&gt;</h1>
                <p>(developer/student)</p>
    <?php
        // Echo session variables that were set on previous page
        if (isset($_SESSION["username"])) {
            echo "<br><p>Welcome " . $_SESSION["username"] . "!</p>";
        }
    ?>
        
            </div>
        </div>
</section>

<!-- about me section -->
<section id="two">
        <div id="text-content-two">
            <div>
                <h3>Hello!</h3>
                <h1>I'm Alejandro De Guzman,</h1>
                <p id="short-intro">an <strong>Undergraduate</strong> Computer Science Student at QMUL based in London.</p>
            </div> 
            <div id="code-snippet">
                <!-- pre tag used to preserve whitespace, line breaks, and indentation as exactly written which is good for code snippets like this  -->
                <pre>
<!-- code semantic tage used to mark contents as computer code -->
<code class="language-java">String[] hobbies = {"bouldering", "origami", "football", "gym", "running"};  
String[] languages = {"python", "java", "javascript", "SQL"};  
String[] technologies = {  
"planckJS",  
"pixiJS",  
"Pygame",  
"Pandas",  
"Bootstrap", 
"Redis", 
"MongoDB" 
}; </code> 
        </pre>    
    </div>
    <p>Take a look at my code on <a href="https://github.com/3NJDGZ">GitHub</a>, and connect with me on <a href="https://www.linkedin.com/in/alejandro-de-guzman/">LinkedIn</a>!</p>
</div>
</section>

    <!-- projects/achievements section -->
<section id="three">
    <div class="flex-container">
        <h2>(projects.)</h2>
        <div class="project" id="project-one">
            <div class="project-content">
                <div class="project-title">
                    <h3>&lt;TANK SQUARED&gt;</h3>
                    <figure>
                        <img id="tankSquaredImg" src="./assets/images/TANK_SQUARED.png" alt="">
                    </figure>   
                </div>
                <div class="project-description">
                    <p>PixiJS turn by turn multiplayer tank game in development.</p>
                    <a href="https://github.com/Chris33871/tank_squared">(See here...)</a>
                </div>
            </div>
            <div class="tech-stack">
                <ul>
                    <li>PixiJS</li>
                    <li>PlanckJS</li>
                    <li>JavaScript</li>
                    <li>Websocket</li>
                </ul>
            </div>    
        </div> 

        <!-- project two  -->
        <div class="project" id="project-two">
            <div class="project-content">
                <div class="project-title">
                    <h3>&lt;PacePattern&gt;</h3>
                    <figure>
                        <img id="pacePatternImg" src="./assets/images/RDAT.png" alt="">
                    </figure>   
                </div>
                <div class="project-description">
                    <p>A web app integrating Garmin Connect API to extract, analyse, and visualise data with actionable insights.</p>
                    <a href="https://github.com/3NJDGZ/PacePattern">(See here...)</a>
                </div>
            </div>
            <div class="tech-stack">
                <ul>
                    <li>Python</li>
                    <li>Pandas</li>
                    <li>Redis</li>
                    <li>MongoDB</li>
                    <li>Matplotlib</li>
                </ul>
            </div>    
        </div>

        <div class="project" id="project-three">
            <div class="project-content">
                <div class="project-title">
                    <h3>&lt;Maze Mind&gt;</h3>
                    <figure>
                        <img id="mazeMindImg" src="./assets/images/MAZE_MIND.png" alt="">
                    </figure>   
                </div>
                <div class="project-description">
                    <p>An app using mini-games to train cognitive skills, track scores, and deliver analysed insights to users.</p>
                    <a href="https://github.com/3NJDGZ/MazeMind">(See here...)</a>
                </div>
            </div>
            <div class="tech-stack">
                <ul>
                    <li>Python</li>
                    <li>Pygame</li>
                    <li>MySQL</li>
                    <li>argon2</li>
                    <li>Pygame_GUI</li>
                </ul>
            </div>    
        </div>
        <div class="project" id="project-four">
            <div class="project-content">
                <div class="project-title">
                    <h3>&lt;Portfolio Website&gt;</h3>
                    <figure>
                        <img id="portfolioImg" src="./assets/images/lebronjamesgoat.jpg" alt="">
                    </figure>   
                </div>
                <div class="project-description">
                    <p>This current website you are looking at, made with my bare hands! Currently made with just pure HTML and CSS</p>
                    <a href="https://github.com/3NJDGZ/Portfolio-Website">(See here...)</a>
                </div>
            </div>
            <div class="tech-stack">
                <ul>
                    <li>HTML</li>
                    <li>CSS</li>
                    <li>PHP</li>
                    <li>JavaScript</li>
                </ul>
            </div>    
        </div>
    </div> 
</section> 

<section id="six">
    <div class="flex-container">
        <h3>(education.)</h3>
            <div class="project">
                <h4>(university.)</h4>
                <p>Studying Computer Science at Queen Mary University of London as a first year undergraduate student.</p>
                <h4>(a-levels.)</h4>
                <p>Studied Mathematics (A), Physics (B), and Computer Science (A) at Reading School.</p>
                <h4>(gcses.)</h4>
                <p>Studied at Maiden Erlegh Chiltern Edge.</p>
                <ul>
                    <li>Mathematics 9</li>
                    <li>Biology 9</li>
                    <li>Computer Science 9</li>
                    <li>Chemistry 9</li>
                    <li>Physics 8</li>
                    <li>Tech Design 8</li>
                    <li>Geography 8</li>
                    <li>English Language 8</li>
                    <li>English Literature 7</li>
                    <li>French 6</li>
                </ul>
            </div>
    </div>
</section>

<section id="four">
    <div id="contact-form-div">
        <h3>(contact me.)</h3>
        <div id="contact-info">
            <p>(email.) alejandrodeguzman@proton.me</p>
            <p>(tel.) +447853422545</p>
        </div>
        <form>
            <div>
                <input type="text" id="fname" name="firstname" placeholder="Your first name" required>
                <input type="text" id="lname" name="lastname" placeholder="Your last name" required>
                <input type="email" id="email" name="email" placeholder="Your email" required>   
                <textarea id="message" name="message" placeholder="Write a message..." style="height=200px" required></textarea>
                <input type="submit" value="(submit.)">   
                <input type="reset" value="(clear.)">   
            </div>
        </form> 
    </div>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
