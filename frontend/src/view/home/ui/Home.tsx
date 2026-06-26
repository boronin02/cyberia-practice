"use client";
import { Awards } from "@/widgets/Awards/ui/Awards";
import { Header } from "@/widgets/Header/ui/Header";
import { Hero } from "@/widgets/Hero/ui/Hero";
import { Projects } from "@/widgets/Projects/ui/Projects";

export const Home = () => {
  return (
    <>
      <Header />
      <Hero />
      <Awards />
      <Projects />
    </>
  );
};
