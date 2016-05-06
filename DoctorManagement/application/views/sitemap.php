<?php 
	header('Content-type: application/xml');
	echo ('<?xml version="1.0" encoding="UTF-8" ?>'); 
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://voyagermed.com/</loc> 
        <changefreq>hourly</changefreq>
        <priority>1.0</priority>
    </url>

<?php
	// Loop thru doctors
	for($i=0;$i<$doctors['count'];$i++) {
        //var_dump($doctors['results'][$i]['link']);exit;
        if($doctors['results'][$i]['link'] == "Richard-D'amico") continue;
        if($doctors['results'][$i]['link'] == "T.-O'daniel") continue;
?>
	<url>
        <loc><?php echo 'https://voyagermed.com/doctors/'.$doctors['results'][$i]['link']; ?></loc>
        <changefreq>daily</changefreq>
        <priority><?php echo $doctors['results'][$i]['priority']; ?></priority>
    </url>
<?php
	}

	// Loop thru the searches
	for($i=0;$i<count($search);$i++) {
?>
	<url>
        <loc><?php echo $search[$i]; ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.7</priority>
    </url>
<?php
	}

	// Loop thru the community pages
	for($i=0;$i<$community['count'];$i++) {
?>
	<url>
        <loc><?php echo 'https://voyagermed.com/community/'.$community['results'][$i]['link']; ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
    </url>
<?php
	}
?>

	<url>
		<loc>https://voyagermed.com/about</loc>
		<changefreq>never</changefreq>
		<priority>0.4</priority>
	</url>

	<url>
		<loc>https://voyagermed.com/terms</loc>
		<changefreq>never</changefreq>
		<priority>0.4</priority>
	</url>

	<url>
		<loc>https://voyagermed.com/privacy</loc>
		<changefreq>never</changefreq>
		<priority>0.4</priority>
	</url>
    
    <url>
        <loc>https://voyagermed.com/search</loc>
        <changefreq>never</changefreq>
        <priority>0.4</priority>
    </url>
</urlset>