import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


import {HomeComponent} from "./home/home.component";
import {NotFoundComponent} from "./not-found/not-found.component";
import {ProductsComponent} from "./products/products.component";


const routes: Routes = [
    { path: '', component: HomeComponent , pathMatch:'full'},
	{ path: 'home', component: HomeComponent },
    { path: 'products', component: ProductsComponent},
    
    { path: '**', component: NotFoundComponent },  
];

@NgModule({
  declarations:[],
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
