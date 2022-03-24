<?php

namespace App\Http\Controllers\Api;

use App\Models\{Category, SubCategory, Content, SubContent, SubSubContent};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDOException;

class ApiConroller extends Controller
{
    public function categoryList(Request $request) {
        try {

            $query = Category::query();
			if ($request->type_id) {
				$query->where('type_id', $request->type_id);
			}
			$data = $query->get();

            return respondWithSuccess('Category fetched successfully', $data);
        
        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 422);
        }
    }
    public function subCategoryList(Request $request) {
      try {
            $query = SubCategory::query();
			if ($request->category_id) {
				$query->where('category_id', $request->category_id);
			}

			$data = $query->get();
            return respondWithSuccess('subCategoryList fetched successfully', $data);
        
        } catch (PDOException $e) {
            
            return respondWithError($e->getMessage(), 422);
        }
    }
    public function contentList(Request $request) {
        try {
			$query = Content::query()
			->leftJoin('sub_categories', 'sub_categories.id', '=', 'contents.sub_category_id')
			->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
			->select('contents.*', 'categories.id as category_id');
			if ($request->sub_category_id) {
				$query->where('contents.sub_category_id', $request->sub_category_id);
			}

			$data = $query->get();
            return respondWithSuccess('contentList fetched successfully', $data);
        
        } catch (PDOException $e) {
            
            return respondWithError($e->getMessage(), 422);
        }
    }
    public function subContentList(Request $request) {
      try {
			$query = SubContent::query()
			->leftJoin('contents', 'sub_contents.content_id', '=', 'contents.id')
			->leftJoin('sub_categories', 'sub_categories.id', '=', 'contents.sub_category_id')
			->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
			->select('sub_contents.*', 'categories.id as category_id', 'contents.sub_category_id');
			if ($request->content_id) {
				$query->where('sub_contents.content_id', $request->content_id);
			}

			$data = $query->get();
            return respondWithSuccess('subContentList fetched successfully', $data);
        
        } catch (PDOException $e) {
            
            return respondWithError($e->getMessage(), 422);
        }
    }
    public function subSubContentList(Request $request) {
        try {
			$query = SubSubContent::query()
			->leftJoin('sub_contents', 'sub_sub_contents.sub_content_id', '=', 'sub_contents.id')
			->leftJoin('contents', 'sub_contents.content_id', '=', 'contents.id')
			->leftJoin('sub_categories', 'sub_categories.id', '=', 'contents.sub_category_id')
			->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
			->select('sub_sub_contents.*', 'categories.id as category_id', 'contents.sub_category_id','sub_contents.content_id');
			if ($request->category_id) {
				$query->where('categories.category_id', $request->category_id);
			}
			if ($request->sub_category_id) {
				$query->where('sub_categories.sub_category_id', $request->sub_category_id);
			}
			if ($request->sub_content_id) {
				$query->where('sub_sub_contents.sub_content_id', $request->sub_content_id);
			}

			$data = $query->get();
            return respondWithSuccess('subSubContentList fetched successfully', $data);
        
        } catch (PDOException $e) {
            
            return respondWithError($e->getMessage(), 422);
        }
    }

}
