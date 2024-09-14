import { Component, OnInit } from '@angular/core';
import { CategoryService } from '../../services/category.service';

@Component({
  selector: 'app-categories',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.css']
})
export class CategoriesComponent implements OnInit {
  categories: any = [];

  constructor(private categoryService: CategoryService) {}

  ngOnInit(): void {
    this.categoryService.getCategories().subscribe((data: any) => {
      this.categories = data;
    });
  }

  deleteCategory(id: number): void {
    this.categoryService.deleteCategory(id).subscribe(() => {
      this.categories = this.categories.filter((category: any) => category.id !== id);
    });
  }
}
