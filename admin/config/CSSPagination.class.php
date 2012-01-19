<?php

/**
 * @author Dodit Suprianto
 * Email: d0dit@yahoo.com
 * Website: http://doditsuprianto.com, http://goiklan.co.nr
 * Website: http://www.meozit.com, http://easyads.co.nr
 * 
 * CSSPagination is a pagination class which combines with Cascading Style Sheet for good looking style; 
 * CSSPagination has main function to split all records before they will be loaded into one website, 
 * to be several records in one page (you can determine how many records in one page). 
 * So, if you want to jump at the other page, you can choose once of them. 
 * CSSPagination is easy to use and good looking. I try to throw the complexity code. 
 * The most important is, that you can change the CSS code to make it suitable with your own page style.
 */

class CSSPagination
{
	private $totalrows;
	private $rowsperpage;
	private $website;
	private $page;
	private $sql;
		
	public function __construct($sql, $rowsperpage, $website)
	{
		$this->sql = $sql;
		$this->website = $website;
		$this->rowsperpage = $rowsperpage;
	}
	
	public function setPage($page)
	{
		if (!$page) { $this->page=1; } else  { $this->page = $page; }
	}
	
	public function getLimit()
	{
		return ($this->page - 1) * $this->rowsperpage;
	}
	
	private function getTotalRows()
	{
		$result = @mysql_query($this->sql) or die ("query failed!");	
		$this->totalrows = mysql_num_rows($result);
	}
	
	private function getLastPage()
	{
		return ceil($this->totalrows / $this->rowsperpage);
	}
	
	public function showPage()
	{
		$this->getTotalRows();
		
		$pagination = "";
		$lpm1 = $this->getLastPage() - 1;
		$page = $this->page;
		$prev = $this->page - 1;
		$next = $this->page + 1;
		
		if ($this->getLastPage() > 1)
		{
			if ($page > 1) 
				$pagination .= "<a href=$this->website&page=$prev>&laquo; prev</a>";
			else
				$pagination .= "<span class=\"disabled\">&laquo; prev</span>";
			
			
			if ($this->getLastPage() < 9)
			{	
				for ($counter = 1; $counter <= $this->getLastPage(); $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"current\">".$counter."</span>";
					else
						$pagination .= "<a href=$this->website&page=$counter>".$counter."</a>";					
				}
			}
			
			elseif($this->getLastPage() >= 9)
			{
				if($page < 4)		
				{
					for ($counter = 1; $counter < 6; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&page=$counter/>".$counter."</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a href=$this->website&page=$lpm1>".$lpm1."</a>";
					$pagination .= "<a href=$this->website&page=".$this->getLastPage().">".$this->getLastPage()."</a>";		
				}
				elseif($this->getLastPage() - 3 > $page && $page > 1)
				{
					$pagination .= "<a href=$this->website&page=1>1</a>";
					$pagination .= "<a href=$this->website&page=2>2</a>";
					$pagination .= "...";
					for ($counter = $page - 1; $counter <= $page + 1; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&page=$counter>".$counter."</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a href=$this->website&page=$lpm1>$lpm1</a>";
					$pagination .= "<a href=$this->website&page=".$this->getLastPage().">".$this->getLastPage()."</a>";		
				}
				else
				{
					$pagination .= "<a href=$this->website&page=1>1</a>";
					$pagination .= "<a href=$this->website&page=2>2</a>";
					$pagination .= "...";
					for ($counter = $this->getLastPage() - 4; $counter <= $this->getLastPage(); $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&page=$counter>".$counter."</a>";					
					}
				}
			}
		
		if ($page < $counter - 1) 
			$pagination .= "<a href=$this->website&page=$next>next &raquo;</a>";
		else
			$pagination .= "<span class=\"disabled\">next &raquo;</span>";
		}
		return $pagination;
	}
}
?>