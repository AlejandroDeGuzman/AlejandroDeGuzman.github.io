<?php
    require __DIR__ . '/includes/head.php'; 
?>
<section id="blog-section">
    <div id="contact-form-div">
        <h3>(blog.)</h3>
        <form>
            <h4>(add a blog.)</h4>
            <div>
                <input type="text" id="title" name="title" placeholder="Enter title" required>
                <textarea id="message" name="message" placeholder="Write your text here..." style="height=200px" required></textarea>
                <input type="submit" value="(submit.)">    
                <input type="reset" value="(clear.)">   
            </div>
        </form> 
    </div>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
