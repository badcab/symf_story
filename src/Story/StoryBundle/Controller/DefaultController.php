<?php

namespace Story\StoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Story\StoryBundle\Entity\Story;

class DefaultController extends Controller {

	private function getFullStory($id){
		$dbStory = $this->getDoctrine()->getRepository('StoryStoryBundle:Story');
		$result = array();

		while ($id) {
			$row = $dbStory->find($id);
			$result[] = $row->getLine();
			$id = $row->getP();
		}

		return implode(' ', array_reverse($result));
	}

	public function indexAction(){

		$dbStory = $this->getDoctrine()->getRepository('StoryStoryBundle:Story');

		if(isset($_POST['new_id'])){
			$current_id = (int)$_POST['new_id'] ? (int)$_POST['new_id'] : 1;
		} else {
			$current_id = 1;
		}
		$parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
		$new_text = isset($_POST['new_text']) ? $_POST['new_text'] : '';

		if($parent_id && $new_text){

			$Story = new Story();
			$Story->setP($dbStory->find($parent_id));
			$Story->setLine($new_text);

			$em = $this->getDoctrine()->getManager();
			$em->persist($Story);
			$em->flush();

			$current_id = $Story->getP()->getId();
			$dbStory = $this->getDoctrine()->getRepository('StoryStoryBundle:Story');
		}


		$rows = $dbStory->findByP($current_id);

		$lines = array();

		foreach ($rows as $key => $row) {
			$lines[] = array(
				'id' => $row->getId(),
				'text' => $row->getLine(),
				'has_children' => count($dbStory->findByP($row->getId())),
			);
			$parent_id = $row->getP()->getId();
		}

		$parent_id = $parent_id ? $parent_id : $current_id;

		$full_story = $this->getFullStory($current_id);

		return $this->render('StoryStoryBundle:Default:index.html.twig', array(
			'lines' => $lines,
			'full_story' => $full_story,
			'current_id' => $current_id,
			'parent_id' => $parent_id,


		//	'dbTest' => $dump,
	    ));
	}
}
