"use client";
import { Container } from "@/shared/ui/Container";
import { Awards } from "./components";
import { Hero } from "./components";
import { ProjectsList } from "@/widgets/Projects";

export const Home = () => {
  return (
    <>
      <Container>
        <Hero />
        <Awards />
        <ProjectsList showLoadButton={true} style="home" />
      </Container>
    </>
  );
};
