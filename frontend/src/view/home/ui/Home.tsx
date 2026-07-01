"use client";
import { Container } from "@/shared/ui/Container";
import { Awards } from "@/widgets/Awards/ui/Awards/Awards";
import { Header } from "@/widgets/Header";
import { Hero } from "@/widgets/Hero/ui/Hero/Hero";
import { Projects } from "@/widgets/Projects";

export const Home = () => {
  return (
    <Container>
      <Header />
      <Hero />
      <Awards />
      <Projects />
    </Container>
  );
};
